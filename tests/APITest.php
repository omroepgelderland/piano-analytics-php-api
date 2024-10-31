<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2024 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace atinternet_php_api;

final class APITest extends \PHPUnit\Framework\TestCase {

    private function get_max_request() {
        return new Request(new Client("a", "b"), [
            'sites' => [0],
            'columns' => ["page"],
            'period' => new period\Day(
                new \DateTime('1999-12-01'), new \DateTime('1999-12-31')
            ),
            'cmp_period' => new period\Day(
                new \DateTime('2000-12-01'), new \DateTime('2000-12-31')
            ),
            'property_filter' => new filter\ListOr(
                new filter\ListAnd(
                    new filter\Contains("page", "a"),
                    new filter\GreaterOrEqual("article_id", 5),
                ),
                new filter\IsEmpty("article_id", False),
                new filter\Contains("domain", ["example.org", "www.example.org"]),
            ),
            'metric_filter' => new filter\Greater("m_visits", 1),
            'sort' => ["-m_visits", "page"],
            'max_results' => 100,
            'ignore_null_properties' => True,
        ]);
    }
    
    public function test_min_request() {
        $request = new Request(new Client("a", "b"), [
            'sites' => [0],
            'columns' => ["page"],
            'period' => new period\Day(new \DateTime('1999-12-31'))
        ]);
        $expected = <<<EOT
        {
            "space": {"s": [0]},
            "columns": ["page"],
            "period": {"p1": [{"type": "D", "start": "1999-12-31", "end": "1999-12-31"}]},
            "max-results": 10000,
            "page-num": 1,
            "options": {"ignore_null_properties": false}
        }
        EOT;
        $this->assertJsonStringEqualsJsonString($expected, \json_encode($request));
    }

    public function test_max_request() {
        $expected = <<<EOT
        {
            "space": {"s": [0]},
            "columns": ["page"],
            "period": {
                "p1": [{"type": "D", "start": "1999-12-01", "end": "1999-12-31"}],
                "p2": [{"type": "D", "start": "2000-12-01", "end": "2000-12-31"}]
            },
            "max-results": 100,
            "page-num": 1,
            "options": {"ignore_null_properties": true},
            "filter": {
                "metric": {"m_visits": {"\$gt": 1}},
                "property": {
                    "\$OR": [
                        {"\$AND": [{"page": {"\$lk": "a"}}, {"article_id": {"\$gte": 5}}]},
                        {"article_id": {"\$empty": false}},
                        {"domain": {"\$lk": ["example.org", "www.example.org"]}}
                    ]
                }
            },
            "sort": ["-m_visits", "page"]
        }
        EOT;
        $this->assertJsonStringEqualsJsonString($expected, \json_encode($this->get_max_request()));
    }

    public function test_format_totals() {
        $expected = <<<EOT
        {
            "space": {"s": [0]},
            "columns": [
                "page"
            ],
            "period": {
                "p1": [{
                    "type": "D",
                    "start": "1999-12-01",
                    "end": "1999-12-31"
                }],
                "p2": [{
                    "type": "D",
                    "start": "2000-12-01",
                    "end": "2000-12-31"
                }]
            },
            "options": {"ignore_null_properties": true},
            "filter": {
                "metric": {
                    "m_visits": {
                        "\$gt": 1
                    }
                },
                "property": {
                    "\$OR": [
                        {
                            "\$AND": [
                                {"page": {"\$lk": "a"}},
                                {"article_id": {"\$gte": 5}}
                            ]
                        },
                        {"article_id": {"\$empty": false}},
                        {"domain": {"\$lk": ["example.org","www.example.org"]}}
                    ]
                }
            }
        }
        EOT;
        $request = $this->get_max_request();
        $reflection = new \ReflectionClass(\get_class($request));
        $method = $reflection->getMethod('jsonSerialize_totals');
        $method->setAccessible(true);
        $actual = \json_encode($method->invokeArgs($request, []));
        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }

}

<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2024 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

final class FilterTest extends \PHPUnit\Framework\TestCase {

    public function test_number_equals() {
        $f = new Equals('m_visits', 19);
        $this->assertEqualsCanonicalizing([
            'm_visits' => [
                '$eq' => 19
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_not_equals() {
        $f = new NotEquals('m_visits', 19);
        $this->assertEqualsCanonicalizing([
            'm_visits' => [
                '$neq' => 19
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_in() {
        $f = new In('article_id', [2, 3, 4]);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$in' => [2, 3, 4]
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_not_in() {
        $f = new NotIn('article_id', [2, 3, 4]);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$nin' => [2, 3, 4]
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_greater() {
        $f = new Greater('m_visits', 19);
        $this->assertEqualsCanonicalizing([
            'm_visits' => [
                '$gt' => 19
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_greater_or_equal() {
        $f = new GreaterOrEqual('m_visits', 19);
        $this->assertEqualsCanonicalizing([
            'm_visits' => [
                '$gte' => 19
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_less() {
        $f = new Less('m_visits', 19);
        $this->assertEqualsCanonicalizing([
            'm_visits' => [
                '$lt' => 19
            ]
        ], $f->jsonSerialize());
    }

    public function test_number_less_or_equal() {
        $f = new LessOrEqual('m_visits', 19);
        $this->assertEqualsCanonicalizing([
            'm_visits' => [
                '$lte' => 19
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_equals() {
        $f = new Equals("page", "index");
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$eq' => 'index'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_equals() {
        $f = new NotEquals("page", "index");
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$neq' => 'index'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_in() {
        $f = new In("article_id", ["a", "b", "3"]);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$in' => ['a', 'b', '3']
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_in() {
        $f = new NotIn("article_id", ["a", "b", "3"]);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$nin' => ['a', 'b', '3']
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_contains() {
        $f = new Contains("domain", "example.org");
        $this->assertEqualsCanonicalizing([
            'domain' => [
                '$lk' => 'example.org'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_contains_list() {
        $f = new Contains("domain", ["example.org", "www.example.org"]);
        $this->assertEqualsCanonicalizing([
            'domain' => [
                '$lk' => ["example.org", "www.example.org"]
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_contains() {
        $f = new NotContains("domain", "example.org");
        $this->assertEqualsCanonicalizing([
            'domain' => [
                '$nlk' => "example.org"
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_contains_list() {
        $f = new NotContains("domain", ["example.org", "www.example.org"]);
        $this->assertEqualsCanonicalizing([
            'domain' => [
                '$nlk' => ["example.org", "www.example.org"]
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_starts_with() {
        $f = new StartsWith("page", "ind");
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$start' => 'ind'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_starts_with_list() {
        $f = new StartsWith("page", ["ind", "ho"]);
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$start' => ["ind", "ho"]
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_starts_with() {
        $f = new NotStartsWith("page", "ind");
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$nstart' => 'ind'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_starts_with_list() {
        $f = new NotStartsWith("page", ["ind", "ho"]);
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$nstart' => ["ind", "ho"]
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_ends_with() {
        $f = new EndsWith("page", "ex");
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$end' => 'ex'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_ends_with_list() {
        $f = new EndsWith("page", ["ex", "me"]);
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$end' => ["ex", "me"]
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_ends_with() {
        $f = new NotEndsWith("page", "ex");
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$nend' => 'ex'
            ]
        ], $f->jsonSerialize());
    }

    public function test_str_not_ends_with_list() {
        $f = new NotEndsWith("page", ["ex", "me"]);
        $this->assertEqualsCanonicalizing([
            'page' => [
                '$nend' => ["ex", "me"]
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_equals() {
        $f = new Equals("date", new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$eq' => '1999-12-31'
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_not_equals() {
        $f = new NotEquals("date", new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$neq' => '1999-12-31'
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_in() {
        $f = new In("date", [new \DateTime('1999-12-31'), new \DateTime('2000-01-01')]);
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$in' => ['1999-12-31', '2000-01-01']
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_not_in() {
        $f = new NotIn("date", [new \DateTime('1999-12-31'), new \DateTime('2000-01-01')]);
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$nin' => ['1999-12-31', '2000-01-01']
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_greater() {
        $f = new Greater("date", new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$gt' => '1999-12-31'
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_greater_or_equal() {
        $f = new GreaterOrEqual("date", new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$gte' => '1999-12-31'
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_less() {
        $f = new Less("date", new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$lt' => '1999-12-31'
            ]
        ], $f->jsonSerialize());
    }

    public function test_date_less_or_equal() {
        $f = new LessOrEqual("date", new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([
            'date' => [
                '$lte' => '1999-12-31'
            ]
        ], $f->jsonSerialize());
    }

    public function test_is_null() {
        $f = new IsNull("article_id", true);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$na' => true
            ]
        ], $f->jsonSerialize());
    }

    public function test_is_undefined() {
        $f = new IsUndefined("article_id", false);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$undefined' => false
            ]
        ], $f->jsonSerialize());
    }

    public function test_is_empty() {
        $f = new IsEmpty("article_id", true);
        $this->assertEqualsCanonicalizing([
            'article_id' => [
                '$empty' => true
            ]
        ], $f->jsonSerialize());
    }

    public function test_period() {
        $f = new Period("publication_date", "all");
        $this->assertEqualsCanonicalizing([
            'publication_date' => [
                '$period' => 'all'
            ]
        ], $f->jsonSerialize());
    }
}

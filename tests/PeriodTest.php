<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2024 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\period;

final class PeriodTest extends \PHPUnit\Framework\TestCase {

    public function test_single_day_period() {
        $p = new Day(new \DateTime('1999-12-31'));
        $this->assertEqualsCanonicalizing([[
            "type" => "D",
            "start" => "1999-12-31",
            "end" => "1999-12-31"
        ]], $p->jsonSerialize(), );
    }

    public function test_day_period() {
        $p = new Day(
            new \DateTime('1999-12-31'),
            new \DateTime('2000-01-10')
        );
        $this->assertEqualsCanonicalizing([[
            "type" => "D",
            "start" => "1999-12-31",
            "end" => "2000-01-10"
        ]], $p->jsonSerialize());
    }

    public function test_time_period() {
        $p = new Day(
            new \DateTime('1999-12-31 00:00:00'),
            new \DateTime('1999-12-31 23:40:50'),
            true
        );
        $this->assertEqualsCanonicalizing([[
            "type" => "D",
            "start" => "1999-12-31T00:00:00",
            "end" => "1999-12-31T23:40:50"
        ]], $p->jsonSerialize());
    }

    public function test_month_period() {
        $p = new Relative(Relative::MONTH, -1);
        $this->assertEqualsCanonicalizing([[
            'type' => 'R',
            'granularity' => 'M',
            'offset' => -1
        ]], $p->jsonSerialize());
    }
}

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

    public function test_relative_day_period() {
        $p = new RelativeDay(-2);
        $this->assertEqualsCanonicalizing([[
            'type' => 'R',
            'granularity' => 'D',
            'offset' => -2
        ]], $p->jsonSerialize());
    }

    public function test_relative_week_period() {
        $p = new RelativeWeek();
        $this->assertEqualsCanonicalizing([[
            'type' => 'R',
            'granularity' => 'W',
            'offset' => 0
        ]], $p->jsonSerialize());
    }

    public function test_relative_month_period() {
        $p = new RelativeMonth(2);
        $this->assertEqualsCanonicalizing([[
            'type' => 'R',
            'granularity' => 'M',
            'offset' => 2
        ]], $p->jsonSerialize());
    }

    public function test_relative_quarter_period() {
        $p = new RelativeQuarter(-2);
        $this->assertEqualsCanonicalizing([[
            'type' => 'R',
            'granularity' => 'Q',
            'offset' => -2
        ]], $p->jsonSerialize());
    }

    public function test_relative_year_period() {
        $p = new RelativeYear(-2);
        $this->assertEqualsCanonicalizing([[
            'type' => 'R',
            'granularity' => 'Y',
            'offset' => -2
        ]], $p->jsonSerialize());
    }
}

<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2024 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\period;

/**
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/period#relative-periods
 */
class RelativeQuarter extends Relative {

    /**
     * Construct a period of one quarter.
     * @param $offset Offset relative to the current date. 0 is the current quarter,
     * -1 is the previous quarter, etc.
     */
    public function __construct( int $offset = 0 ) {
        parent::__construct('Q', $offset);
    }
}

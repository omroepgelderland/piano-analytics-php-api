<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 20243Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

/**
 * List of filters combined by OR.
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/filter
 */
class ListOr extends FilterList {
    
    protected function get_operator(): string {
        return '$OR';
    }
    
}

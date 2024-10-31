<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace atinternet_php_api\filter;

/**
 * List of filters combined by AND.
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/filter
 */
class ListAnd extends FilterList {
    
    protected function get_operator(): string {
        return '$AND';
    }
    
}

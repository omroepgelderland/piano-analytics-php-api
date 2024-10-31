<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

/**
 * Represents a combination of filters.
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/filter
 * 
 * @phpstan-type JSONType array<string, list<Filter>>
 */
abstract class FilterList implements Filter {

    /** @var list<Filter> */
    private array $filters;
    
    /**
     * @param Filter $filters,...
     */
    public function __construct( Filter ...$filters ) {
        $this->filters = $filters;
    }

    protected abstract function get_operator(): string;
    
    /**
     * @return JSONType
     */
    public function jsonSerialize(): array {
        return $this->get_formatted_filters();
    }
    
    /**
     * @return JSONType
     */
    private function get_formatted_filters(): array {
        return [
            $this->get_operator() => $this->filters
        ];
    }
    
}

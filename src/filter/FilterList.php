<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

use \piano_analytics_api\PianoAnalyticsException;

/**
 * Represents a combination of filters.
 * 
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/filter
 * 
 * @phpstan-import-type JSONType from Endpoint as EndpointJSONType
 * @phpstan-type JSONType array<string, list<Filter>>|EndpointJSONType
 */
abstract class FilterList implements Filter {

    /** @var list<Filter> */
    public array $filters;
    
    /**
     * List of filters. Arguments can be endpoints or other filter lists.
     * The list must contain at least one filter.
     * 
     * @param Filter $filters,...
     */
    public function __construct( Filter ...$filters ) {
        $this->filters = $filters;
    }

    protected abstract function get_operator(): string;
    
    /**
     * Formats the filterlist in JSON format.
     * Throws an exception if the list does not contain any filters.
     * If the list has only one filter then only that filter is returned.
     * 
     * @return JSONType
     * @throws PianoAnalyticsException If the list is empty.
     */
    public function jsonSerialize(): array {
        if ( count($this->filters) === 0 ) {
            throw new PianoAnalyticsException('Filterlist cannot be empty');
        }
        elseif ( count($this->filters) === 1 ) {
            return $this->filters[0]->jsonSerialize();
        }
        else {
            return $this->get_formatted_filters();
        }
    }
    
    /**
     * @return JSONType
     */
    private function get_formatted_filters(): array {
        return [
            $this->get_operator() => $this->filters
        ];
    }

    /**
     * Add a filter or filterlist to this list
     */
    public function add( Filter $filter ): void {
        $this->filters[] = $filter;
    }
    
}

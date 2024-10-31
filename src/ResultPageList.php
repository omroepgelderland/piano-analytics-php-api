<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api;

/**
 * Iterable set of pages with data results.
 * 
 * @implements \Iterator<int, APIResponseType>
 * @phpstan-import-type APIResponseType from Request
 */
class ResultPageList implements \Iterator {
    
    private Request $request;
    private int $page_num;
    
    /**
     * 
     * @param Request $request Data request.
     */
    public function __construct( Request $request ) {
        $this->request = $request;
        $this->page_num = 1;
    }

    /**
     * @throws APIError
     * @return APIResponseType
     */
    public function current(): object {
        $data = $this->request->get_result_page($this->page_num);
        return $data;
    }
    
    public function key(): int {
        return $this->page_num;
    }
    
    public function next(): void {
        $this->page_num++;
    }
    
    public function rewind(): void {
        $this->page_num = 1;
    }
    
    public function valid(): bool {
        return !$this->request->is_after_last_page($this->page_num);
    }
}

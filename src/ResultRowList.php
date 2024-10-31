<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace atinternet_php_api;

/**
 * Iterator for all result rows across multiple pages.
 * @implements \Iterator<int, object>
 */
class ResultRowList implements \Iterator {
    
    private ResultPageList $result_pages;
    /**
     * @var list<object>
     */
    private array $rows;
    private int $row_index;
    private int $total_index;
    
    /**
     * 
     * @param Request $request Data request.
     */
    public function __construct( Request $request ) {
        $this->result_pages = new ResultPageList($request);
        $this->rewind();
    }
    
    /**
     * @throws APIError
     */
    public function current(): object {
        return $this->get_rows()[$this->row_index];
    }
    
    public function key(): int {
        return $this->total_index;
    }
    
    /**
     * 
     * @throws APIError
     */
    public function next(): void {
        $this->row_index++;
        $this->total_index++;
        if ( $this->row_index >= $this->get_row_count() ) {
            unset($this->rows);
            $this->row_index = 0;
            $this->result_pages->next();
        }
    }
    
    public function rewind(): void {
        $this->result_pages->rewind();
        unset($this->rows);
        $this->row_index = 0;
        $this->total_index = 0;
    }
    
    /**
     * 
     * @throws APIError
     */
    public function valid(): bool {
        return $this->result_pages->valid() && $this->row_index < $this->get_row_count();
    }
    
    /**
     * @return list<object>
     * @throws APIError
     */
    private function get_rows(): array {
        if ( !isset($this->rows) ) {
            $page = $this->result_pages->current();
            if ( !isset($page->DataFeed) ) {
                throw new ATInternetError('Key DataFeed missing in response');
            }
            $this->rows ??= $page->DataFeed->Rows;
        }
        return $this->rows;
    }
    
    /**
     * @throws APIError
     */
    private function get_row_count(): int {
        return count($this->get_rows());
    }
    
}

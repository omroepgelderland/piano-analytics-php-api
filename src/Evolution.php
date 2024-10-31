<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace atinternet_php_api;

/**
 * @todo implement
 * @phpstan-type JSONType array{}
 */
class Evolution implements \JsonSerializable {
    
    public function __construct() {
        throw new NotImplementedException();
    }
    
    /**
     * @return JSONType
     */
    public function jsonSerialize(): array {
        return [];
    }
}

<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace atinternet_php_api;

/**
 * General exception for errors within the package.
 */
class ATInternetError extends \Exception {}

/**
 * API error reported by Piano Analytics or Curl.
 */
class APIError extends ATInternetError {

    /**
     * API error code as reported by the Piano Analytics API.
     * https://developers.atinternet-solutions.com/piano-analytics/data-api/technical-information/error-codes
     */
    public ?string $type;
}

class NotImplementedException extends ATInternetError {}

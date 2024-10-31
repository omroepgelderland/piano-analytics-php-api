<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api;

/**
 * General exception for errors within the package.
 */
class PianoAnalyticsException extends \Exception {}

/**
 * API error reported by Piano Analytics or Curl.
 */
class APIError extends PianoAnalyticsException {

    /**
     * API error code as reported by the Piano Analytics API.
     * https://developers.atinternet-solutions.com/piano-analytics/data-api/technical-information/error-codes
     */
    public ?string $type;
}

class NotImplementedException extends PianoAnalyticsException {}

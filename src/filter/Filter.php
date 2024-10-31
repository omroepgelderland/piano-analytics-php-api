<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

/**
 * A filter can be a statement (Endpoint) or a list of (nested) endpoints.
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/filter
 */
interface Filter extends \JsonSerializable {}

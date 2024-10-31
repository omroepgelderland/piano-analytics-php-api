<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\period;

/**
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/period#relative-periods
 * 
 * @phpstan-type JSONType list<array{
 *     type: 'R',
 *     granularity: RelativeGranularity,
 *     offset: int
 * }>
 * @phpstan-type RelativeGranularity 'Y'|'Q'|'M'|'W'|'D'
 */
class Relative implements Period {
    
    public const YEAR = 'Y';
    public const QUARTER = 'Q';
    public const MONTH = 'M';
    public const WEEK = 'W';
    public const DAY = 'D';
    
    /** @var RelativeGranularity */
    private string $granularity;
    private int $offset;
    
    /**
     * 
     * @param RelativeGranularity $granularity Time period.
     * @param int $offset Offset relative to the current data. Can be negative.
     */
    public function __construct( string $granularity, int $offset ) {
        $this->granularity = $granularity;
        $this->offset = $offset;
    }
    
    /**
     * @return JSONType
     */
    public function jsonSerialize(): array {
        return [
            [
                'type' => 'R',
                'granularity' => $this->granularity,
                'offset' => $this->offset
            ]
        ];
    }
    
}

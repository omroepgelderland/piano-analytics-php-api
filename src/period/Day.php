<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\period;

/**
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/period#absolute-periods
 * 
 * @phpstan-type JSONType list<array{
 *     type: 'D',
 *     start: string,
 *     end: string
 * }>
 */
final class Day implements Absolute {
    
    private \DateTime $start;
    private \DateTime $end;
    private bool $include_time;
    
    /**
     * 
     * @param $start Start of period.
     * @param $end End of period. If not specified the end date will be the same
     * date as the start.
     * @param bool $include_time Whether to include the time values of the start
     * and end times (default false).
     */
    public function __construct(
        \DateTime $start,
        ?\DateTime $end = null,
        bool $include_time = false
    ) {
        $this->start = $start;
        $this->end = $end ?? $start;
        $this->include_time = $include_time;
    }
    
    /**
     * @return JSONType
     */
    public function jsonSerialize(): array {
        $format = $this->include_time ? 'Y-m-d\TH:i:s' : 'Y-m-d';
        return [
            [
                'type' => 'D',
                'start' => $this->start->format($format),
                'end' => $this->end->format($format)
            ]
        ];
    }

    /**
     * Creates a period for only the current day.
     */
    public static function today(): static {
        return new static(
            (new \DateTime())->setTime(0, 0, 0, 0),
            null,
            false
        );
    }
    
}

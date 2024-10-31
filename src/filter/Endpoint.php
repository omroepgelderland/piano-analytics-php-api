<?php
/**
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2023 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

/**
 * Represents a filter statement.
 * https://developers.atinternet-solutions.com/piano-analytics/data-api/parameters/filter
 * 
 * @phpstan-type JSONType array<string, array<string, int | string | bool | list<int> | list<string>>>
 * @phpstan-type ExpressionType int | string | bool | \DateTime | list<int> | list<string> | list<\DateTime>
 */
abstract class Endpoint implements Filter {
    
    private string $field;
    private string $operator;
    /** @var ExpressionType */
    private mixed $expression;
    
    /**
     * 
     * @param string $field Property or metric to compare.
     * @param string $operator Comparison operator.
     * @param ExpressionType $expression Comparison expression (integer, string, date or
     * array)
     */
    public function __construct( string $field, string $operator, $expression ) {
        $this->field = $field;
        $this->operator = $operator;
        $this->expression = $expression;
    }
    
    /**
     * @return JSONType
     */
    public function jsonSerialize(): array {
        if ( \is_array($this->expression) ) {
            $expression = \array_map(
                fn($value) => $value instanceof \DateTime ? $value->format('Y-m-d') : $value,
                $this->expression
            );
        }
        else if ($this->expression instanceof \DateTime ) {
            $expression = $this->expression->format('Y-m-d');
        }
        else {
            $expression = $this->expression;
        }
        return [
            $this->field => [
                $this->operator => $expression
            ]
        ];
    }
    
}

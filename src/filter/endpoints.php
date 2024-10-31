<?php
/**
 * Collection of filters.
 * 
 * @author Remy Glaser <rglaser@gld.nl>
 * 
 * © 2024 Omroep Gelderland
 * SPDX-License-Identifier: MIT
 */

namespace piano_analytics_api\filter;

class Equals extends Endpoint {
    public function __construct(
        string $field,
        int|string|\DateTime $expression
    ) {
        parent::__construct($field, '$eq', $expression);
    }
}

class NotEquals extends Endpoint {
    public function __construct(
        string $field,
        int|string|\DateTime $expression
    ) {
        parent::__construct($field, '$neq', $expression);
    }
}

class In extends Endpoint {
    /**
     * @param list<int>|list<string>|list<\DateTime> $expression
     */
    public function __construct(
        string $field,
        array $expression
    ) {
        parent::__construct($field, '$in', $expression);
    }
}

class NotIn extends Endpoint {
    /**
     * @param list<int>|list<string>|list<\DateTime> $expression
     */
    public function __construct(
        string $field,
        array $expression
    ) {
        parent::__construct($field, '$nin', $expression);
    }
}

class Greater extends Endpoint {
    public function __construct(
        string $field,
        int|\DateTime $expression
    ) {
        parent::__construct($field, '$gt', $expression);
    }
}

class GreaterOrEqual extends Endpoint {
    public function __construct(
        string $field,
        int|\DateTime $expression
    ) {
        parent::__construct($field, '$gte', $expression);
    }
}

class Less extends Endpoint {
    public function __construct(
        string $field,
        int|\DateTime $expression
    ) {
        parent::__construct($field, '$lt', $expression);
    }
}

class LessOrEqual extends Endpoint {
    public function __construct(
        string $field,
        int|\DateTime $expression
    ) {
        parent::__construct($field, '$lte', $expression);
    }
}

class Contains extends Endpoint {
    /**
     * @param string|list<string> $expression
     */
    public function __construct(
        string $field,
        string|array $expression
    ) {
        parent::__construct($field, '$lk', $expression);
    }
}

class NotContains extends Endpoint {
    /**
     * @param string|list<string> $expression
     */
    public function __construct(
        string $field,
        string|array $expression
    ) {
        parent::__construct($field, '$nlk', $expression);
    }
}

class StartsWith extends Endpoint {
    /**
     * @param string|list<string> $expression
     */
    public function __construct(
        string $field,
        string|array $expression
    ) {
        parent::__construct($field, '$start', $expression);
    }
}

class NotStartsWith extends Endpoint {
    /**
     * @param string|list<string> $expression
     */
    public function __construct(
        string $field,
        string|array $expression
    ) {
        parent::__construct($field, '$nstart', $expression);
    }
}

class EndsWith extends Endpoint {
    /**
     * @param string|list<string> $expression
     */
    public function __construct(
        string $field,
        string|array $expression
    ) {
        parent::__construct($field, '$end', $expression);
    }
}

class NotEndsWith extends Endpoint {
    /**
     * @param string|list<string> $expression
     */
    public function __construct(
        string $field,
        string|array $expression
    ) {
        parent::__construct($field, '$nend', $expression);
    }
}

class IsNull extends Endpoint {
    public function __construct(
        string $field,
        bool $expression
    ) {
        parent::__construct($field, '$na', $expression);
    }
}

class IsUndefined extends Endpoint {
    public function __construct(
        string $field,
        bool $expression
    ) {
        parent::__construct($field, '$undefined', $expression);
    }
}

class IsEmpty extends Endpoint {
    public function __construct(
        string $field,
        bool $expression
    ) {
        parent::__construct($field, '$empty', $expression);
    }
}

class Period extends Endpoint {
    /**
     * @param 'start'|'end'|'all' $expression
     */
    public function __construct(
        string $field,
        string $expression
    ) {
        parent::__construct($field, '$period', $expression);
    }
}

<?php

namespace Viperxes\Rest\ItemSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Amount implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        preg_match(static::NUMBER_OPERATOR_REGEX, $value, $parsedAmount);

        return $builder->where('amount', static::NUMBER_OPERATOR_TRANSLATION[$parsedAmount[1]], $parsedAmount[2]);
    }
}

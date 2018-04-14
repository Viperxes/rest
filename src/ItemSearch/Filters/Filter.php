<?php

namespace Viperxes\Rest\ItemSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    const NUMBER_OPERATOR_REGEX = '/^(eq|gt|gte|lt|lte):(0|[1-9]\d*)$/';
    const NUMBER_OPERATOR_TRANSLATION = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<='
    ];

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value);
}

<?php

namespace Viperxes\Rest\Repositories\Contracts;

interface FilterInterface
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
     * Apply filter in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     * @param $data
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository, $data);
}

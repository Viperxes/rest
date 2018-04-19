<?php

namespace Viperxes\Rest\Repositories\Filters;

use Viperxes\Rest\Repositories\Contracts\FilterInterface;
use Viperxes\Rest\Repositories\Contracts\RepositoryInterface;

class Amount implements FilterInterface
{
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @param $data
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository, $data)
    {
        preg_match(static::NUMBER_OPERATOR_REGEX, $data['amount'], $parsedAmount);

        return $model->where('amount', static::NUMBER_OPERATOR_TRANSLATION[$parsedAmount[1]], $parsedAmount[2]);
    }
}

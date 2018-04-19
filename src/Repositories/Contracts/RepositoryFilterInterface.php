<?php

namespace Viperxes\Rest\Repositories\Contracts;

interface RepositoryFilterInterface
{
    /**
     * Find data by Filter
     *
     * @param FilterInterface $filter
     * @param $data
     * @return mixed
     */
    public function getByFilter(FilterInterface $filter, $data = []);

    /**
     * Skip Filter
     *
     * @param bool $status
     * @return $this
     */
    public function skipFilter($status = true);
}
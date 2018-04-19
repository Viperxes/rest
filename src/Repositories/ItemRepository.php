<?php

namespace Viperxes\Rest\Repositories;

use Viperxes\Rest\Models\Item;

class ItemRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Item::class;
    }
}
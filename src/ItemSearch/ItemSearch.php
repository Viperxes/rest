<?php

namespace Viperxes\Rest\ItemSearch;

use Illuminate\Http\Request;
use Viperxes\Rest\ItemSearch\Filters\Amount;
use Viperxes\Rest\Models\Item;

class ItemSearch
{
    public static function apply(Request $filters)
    {
        $query = (new Item)->newQuery();
        $query = static::applyFiltersToQuery($filters, $query);

        return $query->get();
    }

    private static function applyFiltersToQuery(Request $filters, $query)
    {
        if ($filters->has('amount')) {
            $query = Amount::apply($query, $filters->get('amount'));
        }

        return $query;
    }
}

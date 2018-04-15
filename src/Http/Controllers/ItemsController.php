<?php

namespace Viperxes\Rest\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Viperxes\Rest\ItemSearch\ItemSearch;
use Viperxes\Rest\Models\Item;
use Viperxes\Rest\Rules\NumberOperatorFilter;

class ItemsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'amount' => new NumberOperatorFilter
        ]);

        return response()->json(ItemSearch::apply($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'numeric|unique:items',
            'name' => 'required|string|min:1|unique:items',
            'amount' => 'required|numeric|min:0'
        ]);

        $item = Item::create($data);

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required|string|min:1|unique:items,name,' . $item->id,
            'amount' => 'required|numeric|min:0'
        ]);

        $item->update($data);

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item  $item
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(null, 204);
    }
}

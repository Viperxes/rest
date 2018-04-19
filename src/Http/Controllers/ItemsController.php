<?php

namespace Viperxes\Rest\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Viperxes\Rest\Http\Requests\ {
    SearchItems, StoreItem, UpdateItem
};
use Viperxes\Rest\Http\Responses\StatusCodes;
use Viperxes\Rest\Repositories\Filters\Amount;
use Viperxes\Rest\Repositories\ItemRepository;

class ItemsController extends BaseController
{
    protected $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param SearchItems $request
     * @return Response
     */
    public function index(SearchItems $request)
    {
        $items = $this->repository->skipFilter(!$request->has('amount'))
            ->getByFilter(new Amount(), $request->all())->all();

        return response()->json($items, StatusCodes::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItem $request
     * @return Response
     */
    public function store(StoreItem $request)
    {
        $item = $this->repository->create($request->all());

        return response()->json($item, StatusCodes::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json($this->repository->find($id), StatusCodes::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItem $request
     * @param $id
     * @return Response
     */
    public function update(UpdateItem $request, $id)
    {
        $item = $this->repository->update($request->all(), $id);

        return response()->json($item, StatusCodes::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(null, StatusCodes::HTTP_NO_CONTENT);
    }
}

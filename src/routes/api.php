<?php

Route::apiResource('api/v1/items', 'Viperxes\Rest\Http\Controllers\ItemsController', [
    'middleware' => 'api'
]);

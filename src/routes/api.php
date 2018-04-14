<?php

Route::group([
    'namespace' => 'Viperxes\Rest\Http\Controllers',
    'prefix' => 'api',
    'middleware' => 'api'
], function () {
    Route::get('items', 'ItemsController@index');
    Route::get('items/{item}', 'ItemsController@show');
    Route::post('items', 'ItemsController@store');
    Route::put('items/{item}', 'ItemsController@update');
    Route::delete('items/{item}', 'ItemsController@destroy');
});

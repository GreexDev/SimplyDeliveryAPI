<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "/api", "middleware" => ["api_key"]], function () use ($router){
    $router->get('/items',['uses' => '\App\Http\Controllers\ItemController@index']);
    $router->get('/items/{id}',['uses' => '\App\Http\Controllers\ItemController@show']);
    $router->post('/items',['uses' => '\App\Http\Controllers\ItemController@store']);
    $router->put('/items/{id}',['uses' => '\App\Http\Controllers\ItemController@update']);
    $router->delete('/items/{id}',['uses' => '\App\Http\Controllers\ItemController@delete']);
});

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
    //return $router->app->version();
    return view('index', ['version' => $router->app->version()]);
});

//Comments: added default prefix api/v1 if tom we need to introduce versioning in apis 
$router->group(['prefix' => 'api/v1/'], function () use ($router) {
    $router->get('news', 'NewsController@getNews');
    $router->post('news/create', 'NewsController@createNews');
    $router->get('news/{id}', 'NewsController@getById');
    $router->put('news/update/{id}', 'NewsController@updateNews');
    $router->delete('news/delete/{id}', 'NewsController@deleteNews');
});

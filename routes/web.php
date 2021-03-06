<?php

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



$router->group(['prefix' => "/user"], function () use ($router) {

    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@create');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/refresh', 'AuthController@refresh');
    });
});



$router->group(['prefix' => "/product"], function () use ($router) {
    $router->post('/getfirst', 'ProductController@getFisrt');
    $router->post('/get', 'ProductController@get');
    $router->post('/find', 'ProductController@getfind');
});

$router->group(['prefix' => "/cart", 'middleware' => 'auth'], function () use ($router) {
    $router->post('/add', 'CartController@addItem');
    $router->post('/getItem', 'CartController@getItem');
    $router->post('/clear', 'CartController@clear');
});

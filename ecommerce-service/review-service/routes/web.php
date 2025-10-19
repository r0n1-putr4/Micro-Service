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
    return json_encode(["message" => "Service Review"]); //$router->app->version();
});


$router->get('/reviews/{produk_id}', 'ReviewController@getReview');
$router->get('/tes/{produk_id}', 'ReviewController@getReviewDua');
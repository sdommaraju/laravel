<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::options('{all}', function () {
    $response = Response::make('');

    if(!empty($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], ['http://localhost:9001'])) {
        $response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
    } else {
        $response->header('Access-Control-Allow-Origin', url()->current());
    }
    $response->header('Access-Control-Allow-Headers', '*');
    $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
    $response->header('Access-Control-Allow-Credentials', 'true');
    $response->header('X-Content-Type-Options', 'nosniff');

    return $response;
});

require('api_routes.php');
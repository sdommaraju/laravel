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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->post('access_token', function() {
        return Response::json(Authorizer::issueAccessToken());
    });
    
});


$api->version('v1',['prefix' => 'api','namespace' => 'App\Http\Controllers\Api'],function ($api) {
    
    $api->group(['middleware' => 'oauth-client'],function($api){
        $api->get('users', 'UserController@index');
    });
    
   
    $api->group(['middleware' => 'oauth','oauth-user'],function($api){
        
        $api->resource('users', 'UserController');
       
        $api->get('user/profile', 'UserController@profile');
        
        $api->get('user/roles', 'UserController@roles');
        
        $api->get('user/groups', 'UserController@groups');
        
    });
        
});
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
    /**
     * @api {post} /access_token User Authentication.
     * @apiVersion 1.0.0
     * @apiName UserAuthenticate
     * @apiGroup Authentication
     * @apiParam {String} grant_type=password Token Grant Type
     * @apiParam {String} client_id Client ID
     * @apiParam {String} client_secret Client Secret
     * @apiParam {String} username Employee Login Email
     * @apiParam {String} password Employee Password
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *     "access_token": "cyOsBqJl16ZM6PLxS1c5HaLZ6gViEeO6fq2fODsL",
     *     "token_type": "Bearer",
     *     "expires_in": 3600,
     *     "refresh_token": "AuUZnQ3xmuuTZzxN4XaFWlAovmfwL1RICQmdeMF7"
     *   }
     *
     * @apiError Error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 500 Server Error
     *     {
     *       "message": "The user credentials were incorrect.",
     *       "status_code": 500
     *     }
     */
    $api->post('access_token', function() {
        return Response::json(Authorizer::issueAccessToken());
    });
    
});


$api->version('v1',['prefix' => 'api','namespace' => 'App\Http\Controllers\Api'],function ($api) {
    
//     $api->group(['middleware' => 'oauth-client'],function($api){
//         $api->get('users', 'UserController@index');
//     });
    
   
    $api->group(['middleware' => 'oauth','oauth-user'],function($api){
        
        $api->resource('employees', 'EmployeeController');
       
        $api->get('employee/profile', 'EmployeeController@profile');
        
    });
        
});
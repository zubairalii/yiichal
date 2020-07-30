<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/verif', 'testingController');

Route::post('/broadcast',function (Request $request){
     	$pusher = new Pusher\Pusher(env('PUSHER_APP_KEY'),env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
	return $pusher->socket_auth($request->request->get('channel_name'),$request->request->get('socket_id')); 
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

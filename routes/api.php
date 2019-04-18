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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'posts'], function() {
	Route::get('', "PostsController@index");
	Route::get('data/{id}', "PostsController@getPostData");
	Route::post('', "PostsController@store");
	Route::put('{id}', "PostsController@update");
	Route::delete('{id}', "PostsController@destroy");
});

Route::group(['prefix' => 'tags'], function() {
	Route::get('', "TagsController@index");
});
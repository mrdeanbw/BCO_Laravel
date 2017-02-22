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
Route::group(['middleware' => ['auth:api']], function() {
	Route::get('/user', function (Request $request) {return $request->user();});
	Route::get('/latest_news', 'ApiController@latest_news');
	Route::get('/new_members', 'ApiController@new_members');
	Route::post('/user/edit_symbols', 'ApiController@update_user_stocksymbols');
	Route::get('/forum_posts', 'ApiController@latest_forum_posts');
});



<?php

use Illuminate\Http\Request;
use App\Http\Controllers\DiaryController;

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
Route::get('/diary_list', 'ListController@diaryList');

Route::get('/diary_create_item', 'DiaryController@getCreateItem');

Route::post('/diary_regist', 'DiaryController@regist');
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
//一覧表示
Route::get('/diary_list', 'ListController@diaryList');
//日記の共通項目取得用
Route::get('/diary_item', 'DiaryController@getDiaryItem');
//日記の新規保存用
Route::post('/diary_regist', 'DiaryController@regist');
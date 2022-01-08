<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiaryController extends Controller
{
    /**
     * 日記作成画面表示
     */
    public function getCreateItem()
    {
        return view('create_diary');
    }

    /**
     * 日記の作成・編集内容を登録
     * 
     */
    public function regist(Request $request)
    {
        Log::debug('regist');
        return;
    }
}
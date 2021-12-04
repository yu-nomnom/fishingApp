<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaryController extends Controller
{
    /**
     * 日記作成画面表示 
     */
    public function create()
    {
        return view('create_diary');
    }
}
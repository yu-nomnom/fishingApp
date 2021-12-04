<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * 一覧画面表示用
     * 
     */
    public function list()
    {
        return view('list');
    }
}

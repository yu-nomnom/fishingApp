<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ListController extends BaseController
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

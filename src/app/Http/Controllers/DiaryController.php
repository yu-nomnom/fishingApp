<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiaryController extends Controller
{
    private CommonItemService $commonItemService;

    /**
     * @var CommonItemService $commonItemService
     */
    public function __construct(CommonItemService $commonItemService)
    {
        $this->commonItemService = $commonItemService;
    }

    /**
     * 日記作成画面表示
     */
    public function getCreateItem()
    {
        $weatherList = config('item.weather');
        $seasonList  = config('item.season');
        $tideList    = config('item.tide');
        $fieldList   = $this->commonItemService->getFieldList();
        Log::debug($fieldList);

        return response()->json([
                'weatherList' => $weatherList,
                'seasonList' => $seasonList,
                'tideList' => $tideList,
                'fieldList' => $fieldList
        ]);
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
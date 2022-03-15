<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonItemService;
use App\Http\Services\DiaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 日記新規作成・編集画面のクラス
 */
class DiaryController extends Controller
{
    private CommonItemService $commonItemService;
    private DiaryService $diaryService;

    /**
     * @var CommonItemService $commonItemService
     * @var DiaryService $diaryService
     */
    public function __construct(
        CommonItemService $commonItemService,
        DiaryService $diaryService
    ) {
        $this->commonItemService = $commonItemService;
        $this->diaryService = $diaryService;
    }

    /**
     * 日記作成画面表示
     * 
     * @return json
     */
    public function getDiaryItem()
    {
        $diaryCommonList = $this->commonItemService->getDiaryCommonList();

        return response()->json([
                'weatherList' => $diaryCommonList['weather'],
                'seasonList'  => $diaryCommonList['season'],
                'tideList'    => $diaryCommonList['tide'],
                'fieldList'   => $diaryCommonList['field_list']
        ]);
    }

    /**
     * 日記の作成・編集内容を登録
     * 
     * @param Request $request
     * @return json
     */
    public function regist(Request $request)
    {
        $diaryData      = $request['dairyData'];
        $fishResultData = $request['fishResult'];
        $message = $this->diaryService->createDiary($diaryData, $fishResultData);
        return response()->json([
            'status'  => 200,
            'message' => $message
        ]);
    }
}
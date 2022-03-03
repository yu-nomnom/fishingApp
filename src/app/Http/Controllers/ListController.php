<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommonItemService;
use App\Http\Services\DiaryService;
use Illuminate\Support\Facades\Log;

/**
 * 一覧画面のクラス
 */
class ListController extends Controller
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
     * 日記一覧表示
     * 
     * @return json
     */
    public function diaryList()
    {
        //フィールド、天気、季節、潮などのリストも取得
        $diaryCommonList   = $this->commonItemService->getDiaryCommonList();
        $diaryList = $this->diaryService->getAllDiary();

        return response()->json([
            'weatherList' => $diaryCommonList['weather'],
            'seasonList'  => $diaryCommonList['season'],
            'tideList'    => $diaryCommonList['tide'],
            'fieldList'   => $diaryCommonList['field_list'],
            'diaryList'   => $diaryList
        ]);
    }
}

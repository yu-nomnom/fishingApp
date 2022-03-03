<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonItemService;
use App\Http\Services\RegistDiaryService;
use App\Http\Services\FishResultService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiaryController extends Controller
{
    private CommonItemService $commonItemService;
    private RegistDiaryService $registDiaryService;
    private FishResultService $fishResultService;

    /**
     * @var CommonItemService $commonItemService
     * @var RegistDiaryService $registDiaryService
     * @var FishResultService $fishResultService
     */
    public function __construct(
        CommonItemService $commonItemService,
        RegistDiaryService $registDiaryService,
        FishResultService $fishResultService
    ) {
        $this->commonItemService = $commonItemService;
        $this->registDiaryService = $registDiaryService;
        $this->fishResultService = $fishResultService;
    }

    /**
     * 日記一覧表示
     * 
     * @return json
     */
    public function diaryList()
    {
        Log::debug('diaryList');
        //フィールド、天気、季節、潮などのリストも取得
        $diaryCommonList   = $this->commonItemService->getDiaryCommonList();
        
        
    }

    /**
     * 日記作成画面表示
     * 
     * @return json
     */
    public function getCreateItem()
    {
        $diaryCommonList   = $this->commonItemService->getDiaryCommonList();

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
        $message = $this->registDiaryService->createDiary($diaryData, $fishResultData);
        return response()->json([
            'status'  => 200,
            'message' => $message
        ]);
    }
}
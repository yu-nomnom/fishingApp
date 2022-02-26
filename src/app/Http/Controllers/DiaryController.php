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
     * 日記作成画面表示
     * 
     * @return json
     */
    public function getCreateItem()
    {
        $weatherList = config('item.weather');
        $seasonList  = config('item.season');
        $tideList    = config('item.tide');
        $fieldList   = $this->commonItemService->getFieldList();

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
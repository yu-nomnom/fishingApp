<?php

namespace App\Http\Controllers;

use App\Http\Services\CommonItemService;
use App\Http\Services\RegistDiaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiaryController extends Controller
{
    private CommonItemService $commonItemService;
    private RegistDiaryService $registDiaryService;

    /**
     * @var CommonItemService $commonItemService
     * @var RegistDiaryService $registDiaryService
     */
    public function __construct(
        CommonItemService $commonItemService,
        RegistDiaryService $registDiaryService
    ) {
        $this->commonItemService = $commonItemService;
        $this->registDiaryService = $registDiaryService;
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

        return response()->json([
                'weatherList' => $weatherList,
                'seasonList' => $seasonList,
                'tideList' => $tideList,
                'fieldList' => $fieldList
        ]);
    }

    /**
     * 日記の作成・編集内容を登録
     * @var Request $request
     */
    public function regist(Request $request)
    {
        $dairyData = $request['dairyData'];
        $dairyData = $this->registDiaryService->formatRegisterData($dairyData);
        $this->registDiaryService->insertDiary($dairyData);
        return;
    }
}
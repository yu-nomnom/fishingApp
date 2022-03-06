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
        $diaryList = $this->diaryService->getAllDiary();

        return $diaryList;
    }
}

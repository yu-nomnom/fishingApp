<?php

namespace App\Http\Controllers;

use App\Http\Services\DiaryService;

/**
 * 一覧画面のクラス
 */
class ListController extends Controller
{
    private DiaryService $diaryService;

    /**
     * @var DiaryService $diaryService
     */
    public function __construct(
        DiaryService $diaryService
    ) {
        $this->diaryService = $diaryService;
    }

    /**
     * 日記一覧表示
     * 
     * @return json
     */
    public function diaryList()
    {
        $data = $this->diaryService->getAllDiary();

        return $data;
    }
}

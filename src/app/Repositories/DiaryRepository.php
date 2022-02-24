<?php

namespace App\Repositories;

use App\Models\Diary;
use Illuminate\Support\Facades\Log;

class DiaryRepository implements Interfaces\DiaryRepositoryInterface
{
    /**
     * 釣り日記新規作成
     * 
     * @param array $diaryData
     * @return object
     */
    public function createDiary(array $diaryData)
    {
        return Diary::create($diaryData);
    }
}
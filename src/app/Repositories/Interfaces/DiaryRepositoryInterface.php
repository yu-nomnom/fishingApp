<?php

namespace App\Repositories\Interfaces;

interface DiaryRepositoryInterface
{
    /**
     * 釣り日記新規作成
     * 
     * @param array $diaryData
     * @return
     */
    public function createDiary(array $diaryData);
}
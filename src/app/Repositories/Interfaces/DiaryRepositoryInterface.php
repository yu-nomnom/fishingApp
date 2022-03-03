<?php

namespace App\Repositories\Interfaces;

interface DiaryRepositoryInterface
{
    /**
     * 釣り日記新規作成
     * 
     * @param array $diaryData
     * @return object
     */
    public function createDiary(array $diaryData);

    /**
     * 全ての日記を取得する
     * 
     * @return object 全ての日記データ
     */
    public function getAllDiary();
}
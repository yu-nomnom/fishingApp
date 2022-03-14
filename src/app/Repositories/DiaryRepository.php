<?php

namespace App\Repositories;

use App\Models\Diary;

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

    /**
     * 全ての日記を取得する
     * 
     * @return object 全ての日記データ
     */
    public function getAllDiary()
    {
        return Diary::get()->toArray();
    }

    /**
     * 日記データの総数をカウントする
     * 
     * @return 
     */
    public function countDiary ()
    {
        return Diary::count();
    }
}
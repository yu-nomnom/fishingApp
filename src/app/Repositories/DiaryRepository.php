<?php

namespace App\Repositories;

use App\Models\Diary;
use Illuminate\Support\Facades\DB;

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
     * @return array 全ての日記データ
     */
    public function getAllDiary()
    {
        $query = Diary::join('field', 'diaries.field_id', '=', 'field.id');

        $raw = DB::raw("diaries.id, CASE diaries.competition_flg WHEN 1 THEN '○' ELSE null END AS competition_flg, 
                        diaries.title, field.field_name as field, diaries.season, diaries.weather, diaries.tide");

        return $query->select($raw)
                     ->get()->toArray();
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
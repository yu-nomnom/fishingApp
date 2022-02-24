<?php

namespace App\Http\Services;

use Illuminate\Support\Carbon;

class FishResultService {

    /**
     * 
     */
    public function __construct ()
    {

    }

    /**
     * 日記の登録・編集時のデータ生成用
     * 
     * @param array $fishResultData 釣果データ
     * @param int $diaryId 日記ID
     * @return array $fishResultData 釣果データ
     */
    public function formatRegisterData(array $fishResultData, int $diaryId)
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        
        foreach (array_keys($fishResultData) as $key) {
            $fishResultData[$key] += [
                'diary_id' => $diaryId,
                'created' => $dateTime,
                'created_user_id' => 'yusuke',
                'modified' => $dateTime,
                'modified_user_id' => 'yusuke'
            ];
        }

        return $fishResultData;
    }
}
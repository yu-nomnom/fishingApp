<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class RegistDiaryService
{
    /**
     * 日記の登録・編集時のデータ生成用
     * 
     * @param array $dairyData
     * @return array $dairyData
     */
    public function formatRegisterData(array $dairyData)
    {
        $dateTime = Carbon::now();
        // Log::debug('formatRegisterData');
        // Log::debug($dateTime);
        // Log::debug(gettype($dateTime));

        $dairyData += [
            'fish_result_id' => null,
            'created' => $dateTime,
            'created_user_id' => 'yusuke', //後でユーザーを使用するように変更
            'modified' => $dateTime,
            'modified_user_id' => 'yusuke' //後でユーザーを使用するように変更
        ];
        // Log::debug($dairyData);
        return $dairyData;
    }
    /**
     * 日記新規保存処理
     * 
     * @param array $dairyData 日記作成用データ
     */
    public function insertDiary(array $dairyData)
    {
        return;
    }

    /**
     * 日記編集保存処理
     */
    public function updateDiary()
    {
        return;
    }
}
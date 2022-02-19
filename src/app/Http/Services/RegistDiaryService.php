<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\DiaryRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class RegistDiaryService
{
    private DiaryRepositoryInterface $diaryRepository;

    /**
     * @var DiaryRepositoryInterface $diaryRepository
     */
    public function __construct(DiaryRepositoryInterface $diaryRepository)
    {
        $this->diaryRepository = $diaryRepository;
    }

    /**
     * 日記の登録・編集時のデータ生成用
     * 
     * @param array $diaryData
     * @return array $diaryData
     */
    public function formatRegisterData(array $diaryData)
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        $diaryData['lowest_temperature'] = (int)$diaryData['lowest_temperature'];
        $diaryData['highest_temperature'] = (int)$diaryData['highest_temperature'];
        $diaryData['lowest_water_level'] = (int)$diaryData['lowest_water_level'];
        $diaryData['highest_water_level'] = (int)$diaryData['highest_water_level'];

        $diaryData += [
            'fish_result_id' => 1, //後で修正
            'created' => $dateTime,
            'created_user_id' => 'yusuke', //後でユーザーを使用するように変更
            'modified' => $dateTime,
            'modified_user_id' => 'yusuke' //後でユーザーを使用するように変更
        ];
        Log::debug($diaryData);
        return $diaryData;
    }

    /**
     * 日記新規保存処理
     * 
     * @param array $diaryData 日記作成用データ
     */
    public function createDiary(array $diaryData)
    {
        return $this->diaryRepository->createDiary($diaryData);
    }

    /**
     * 日記編集保存処理
     */
    public function updateDiary()
    {
        return;
    }
}
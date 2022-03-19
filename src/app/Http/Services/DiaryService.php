<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\DiaryRepositoryInterface;
use App\Repositories\Interfaces\FishResultRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

/**
 * 日記に関するクラス
 */
class DiaryService
{
    private DiaryRepositoryInterface $diaryRepository;
    private FishResultRepositoryInterface $fishResultRepository;

    /**
     * @var DiaryRepositoryInterface $diaryRepository
     * @var FishResultRepositoryInterface $fishResultRepository
     */
    public function __construct(
        DiaryRepositoryInterface $diaryRepository,
        FishResultRepositoryInterface $fishResultRepository
    ) {
        $this->diaryRepository = $diaryRepository;
        $this->fishResultRepository = $fishResultRepository;
    }

    /**
     * 日記の登録・編集時のデータ生成用
     * 
     * @param array $diaryData
     * @return array $diaryData
     */
    public function formatDiary(array $diaryData)
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        $diaryData += [
            'fish_result_id' => 1, //後で修正
            'created' => $dateTime,
            'created_user_id' => 'yusuke', //後でユーザーを使用するように変更
            'modified' => $dateTime,
            'modified_user_id' => 'yusuke' //後でユーザーを使用するように変更
        ];

        return $diaryData;
    }

    /**
     * 日記の登録・編集時の釣果データ生成用
     * 
     * @param array $fishResultData 釣果データ
     * @param int $diaryId 日記ID
     * @return array $fishResultData 釣果データ
     */
    public function formatFishResult(array $fishResultData, int $diaryId)
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        
        foreach (array_keys($fishResultData) as $key) {
            $fishResultData[$key] += [
                'diary_id' => $diaryId,
                'point_id' => null,
                'created' => $dateTime,
                'created_user_id' => 'yusuke', //後で変更
                'modified' => $dateTime,
                'modified_user_id' => 'yusuke' //後で変更
            ];
        }

        return $fishResultData;
    }

    /**
     * 日記(釣果含む)新規保存処理
     * 
     * @param array $diaryData 日記作成用データ
     * @param array $fishResultData 釣り日記用データ
     * @return string $message 登録の結果
     */
    public function createDiary(array $diaryData, array $fishResultData)
    {
        try {
            $message = config('regist.fail');
            $diaryData = $this->formatDiary($diaryData);
            $result = $this->diaryRepository->createDiary($diaryData);
            $fishResultData = $this->formatFishResult($fishResultData, $result->id);
            $success = $this->fishResultRepository->insertFishResult($fishResultData);
            if ($success) {
                $message = config('regist.success');
            }
        } catch (\Exception $e) {
            Log::error($e);
            $message = config('regist.fail');
        }

        return $message;
    }

    /**
     * 日記編集保存処理
     */
    public function updateDiary()
    {
        return;
    }

    /**
     * 一覧表示画面の日記データを取得
     * 
     * @return array 日記データ
     */
    public function getAllDiary()
    {
        $diary['diaryList'] = $this->diaryRepository->getAllDiary();
        $diary['diaryCount'] = $this->diaryRepository->countDiary();

        return $diary;
    }
}
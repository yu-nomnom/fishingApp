<?php

namespace App\Http\Services;

use App\Http\Services\FishResultService;
use App\Repositories\Interfaces\DiaryRepositoryInterface;
use App\Repositories\Interfaces\FishResultRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\TryCatch;

/**
 * 日記の登録機能に関するクラス
 */
class RegistDiaryService
{
    private FishResultService $fishResultService;
    private DiaryRepositoryInterface $diaryRepository;
    private FishResultRepositoryInterface $fishResultRepository;

    /**
     * @var FishResultService $fishResultService
     * @var DiaryRepositoryInterface $diaryRepository
     * @var FishResultRepositoryInterface $fishResultRepository
     */
    public function __construct(
        FishResultService $fishResultService,
        DiaryRepositoryInterface $diaryRepository,
        FishResultRepositoryInterface $fishResultRepository
    ) {
        $this->fishResultService = $fishResultService;
        $this->diaryRepository = $diaryRepository;
        $this->fishResultRepository = $fishResultRepository;
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
            $diaryData = $this->formatRegisterData($diaryData);
            $result = $this->diaryRepository->createDiary($diaryData);
            $fishResultData = $this->fishResultService->formatRegisterData($fishResultData, $result->id);
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
}
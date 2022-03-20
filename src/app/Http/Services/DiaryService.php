<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\DiaryRepositoryInterface;
use App\Repositories\Interfaces\FishResultRepositoryInterface;
use App\Repositories\Interfaces\FishingContentsRepositoryInterface;
use App\Repositories\Interfaces\FishingConsideRepositroyInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

/**
 * 日記に関するクラス
 */
class DiaryService
{
    private DiaryRepositoryInterface $diaryRepository;
    private FishResultRepositoryInterface $fishResultRepository;
    private FishingContentsRepositoryInterface $fishingContentsRepository;
    private FishingConsideRepositroyInterface $fishingConsideRepositroy;

    /**
     * @var DiaryRepositoryInterface $diaryRepository
     * @var FishResultRepositoryInterface $fishResultRepository
     * @var FishingContentsRepositoryInterface $fishingContentsRepository
     * @var FishingConsideRepositroyInterface $fishingConsideRepositroy
     */
    public function __construct(
        DiaryRepositoryInterface $diaryRepository,
        FishResultRepositoryInterface $fishResultRepository,
        FishingContentsRepositoryInterface $fishingContentsRepository,
        FishingConsideRepositroyInterface $fishingConsideRepositroy
    ) {
        $this->diaryRepository = $diaryRepository;
        $this->fishResultRepository = $fishResultRepository;
        $this->fishingContentsRepository = $fishingContentsRepository;
        $this->fishingConsideRepositroy = $fishingConsideRepositroy;
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

        $diaryData['start_time'] = $diaryData['date']. ' '. $diaryData['start_time'];
        $diaryData['end_time'] = $diaryData['date']. ' '. $diaryData['end_time'];
        unset($diaryData['date']);

        $diaryData += [
            'created' => $dateTime,
            'created_user_id' => 'yusuke', //後でユーザーを使用するように変更
            'modified' => $dateTime,
            'modified_user_id' => 'yusuke' //後でユーザーを使用するように変更
        ];

        return $diaryData;
    }

    /**
     * 釣りの内容テーブルのデータ生成用
     * 
     * @param string $contents 詳細
     * @param int $diaryId 日記ID
     * @return array $fishContentData
     */
    public function formatFishContents(string $contents, int $diaryId)
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        $fishContentData = [
            'diary_id' => $diaryId,
            'contents' => $contents,
            'created' => $dateTime,
            'created_user_id' => 'yusuke', //後でユーザーを使用するように変更
            'modified' => $dateTime,
            'modified_user_id' => 'yusuke' //後でユーザーを使用するように変更
        ];

        return $fishContentData;
    }

    /**
     * 考察テーブルのデータ生成用
     * 
     * @param string $consideration 考察
     * @param int $diaryId 日記ID
     * @return array $fishConsiderationData
     */
    public function formatFishConsideration(string $consideration, int $diaryId)
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        $fishConsiderationData = [
            'diary_id' => $diaryId,
            'consideration' => $consideration,
            'created' => $dateTime,
            'created_user_id' => 'yusuke', //後でユーザーを使用するように変更
            'modified' => $dateTime,
            'modified_user_id' => 'yusuke' //後でユーザーを使用するように変更
        ];

        return $fishConsiderationData;
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
     * 日記(釣果含む)の新規保存処理
     * 
     * @param array $diaryData 日記作成用データ
     * @param string $contents 釣りの内容
     * @param string $consideration 考察
     * @param array $fishResultData 釣果データ
     * @return string $message 登録の結果
     */
    public function createDiary(array $diaryData, string $contents, string $consideration, array $fishResultData)
    {
        try {
            DB::beginTransaction();
            $message = config('regist.fail');
            //日記テーブル保存
            $diaryData = $this->formatDiary($diaryData);
            $diaryResult = $this->diaryRepository->create($diaryData);

            //釣り詳細テーブル保存
            $fishContentData = $this->formatFishContents($contents, $diaryResult->id);
            $this->fishingContentsRepository->create($fishContentData);

            //考察テーブル保存
            $fishConsiderationData = $this->formatFishConsideration($consideration, $diaryResult->id);
            $this->fishingConsideRepositroy->create($fishConsiderationData);

            //釣果テーブル保存
            $success = false;
            if (!empty($fishResultData)) {
                $fishResultData = $this->formatFishResult($fishResultData, $diaryResult->id);
                $success = $this->fishResultRepository->insert($fishResultData);
            }
            if ($success) {
                $message = config('regist.success');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
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
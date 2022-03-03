<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\FieldRepositoryInterface;
use Illuminate\Support\Facades\Log;

/**
 * 共通で使用する配列・項目に関するクラス
 */
class CommonItemService
{
    private FieldRepositoryInterface $fieldRepository;

    /**
     * @var FieldRepositoryInterface $fieldRepository
     */
    public function __construct(FieldRepositoryInterface $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }
    /**
     * 日記一覧・新規作成・編集画面で必要な情報を取得
     * 
     * @return array $diaryCommonList 日記の作成・表示に必要なリスト
     */
    public function getDiaryCommonList()
    {
        $diaryCommonList = [];

        //上から順に天気、季節、潮、フィールド一覧
        $diaryCommonList['weather']    = config('item.weather');
        $diaryCommonList['season']     = config('item.season');
        $diaryCommonList['tide']       = config('item.tide');
        $diaryCommonList['field_list'] = $this->fieldRepository->getAllField();

        return $diaryCommonList;
    }
    
}
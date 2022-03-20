<?php

namespace App\Repositories;

use App\Models\FishingContent;

class FishingContentsRepository implements Interfaces\FishingContentsRepositoryInterface
{
    /**
     * 釣りの内容データの新規登録処理
     * 
     * @param array $fishContentData
     * @return object
     */
    public function create(array $fishContentData)
    {
        FishingContent::create($fishContentData);
    }
}
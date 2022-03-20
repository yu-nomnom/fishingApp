<?php

namespace App\Repositories\Interfaces;

interface FishingContentsRepositoryInterface
{
    /**
     * 釣りの内容データの新規登録処理
     * 
     * @param array $fishContentData
     * @return object
     */
    public function create(array $fishContentData);
}
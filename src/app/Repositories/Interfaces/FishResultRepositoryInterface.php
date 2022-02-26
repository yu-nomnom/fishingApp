<?php

namespace App\Repositories\Interfaces;

interface FishResultRepositoryInterface
{
    /**
     * 釣果情報の新規登録
     * 
     * @param array $fishReultData
     * @return bool
     */
    public function insertFishResult (array $fishReultData);
}
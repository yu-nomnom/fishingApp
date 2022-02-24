<?php

namespace App\Repositories\Interfaces;

interface FishResultRepositoryInterface
{
    /**
     * 釣果情報の新規登録
     * 
     * @param array $fishReultData
     * @return object
     */
    public function createFishResult (array $fishReultData);
}
<?php

namespace App\Repositories;

use App\Models\FishResult;

class FishResultRepository implements Interfaces\FishResultRepositoryInterface
{
    /**
     * 釣果情報の新規登録
     * 
     * @param array $fishReultData
     * @return boolean
     */
    public function insert(array $fishReultData)
    {
        return FishResult::insert($fishReultData);
    }
    
}
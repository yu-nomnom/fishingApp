<?php

namespace App\Repositories;

use App\Models\FishingConsideration;

class FishingConsideRepositroy implements Interfaces\FishingConsideRepositroyInterface
{
    /**
     * 考察データの新規登録処理
     * 
     * @param array $fishConsiderationData
     * @return object
     */
    public function create(array $fishConsiderationData)
    {
        FishingConsideration::create($fishConsiderationData);
    }
}
<?php

namespace App\Repositories\Interfaces;

interface FishingConsideRepositroyInterface
{
    /**
     * 考察データの新規登録処理
     * 
     * @param array $fishConsiderationData
     * @return object
     */
    public function create(array $fishConsiderationData);
}
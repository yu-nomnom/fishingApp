<?php

namespace App\Repositories\Interfaces;

interface FieldRepositoryInterface
{
    /**
     * 全釣り場リストの取得
     * @return array $fieldList 釣り場リスト
     */
    public function getAllField();
}
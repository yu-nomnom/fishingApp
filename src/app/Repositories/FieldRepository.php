<?php

namespace App\Repositories;

use App\Models\Field;

class FieldRepository implements Interfaces\FieldRepositoryInterface
{
    /**
     * 全釣り場リストの取得
     * @return array 釣り場リスト
     */
    public function getAllField()
    {
        return Field::whereNull('deleted_at')
                      ->pluck('field_name', 'id')
                      ->toArray();
    }
}
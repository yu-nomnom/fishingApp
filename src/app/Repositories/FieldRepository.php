<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FieldRepository implements Interfaces\FieldRepositoryInterface
{
    /**
     * 全釣り場リストの取得
     * @return array $fieldList 釣り場リスト
     */
    public function getAllField()
    {
        return DB::table('field')->whereNull('deleted_at')
                                 ->pluck('field_name');
    }
}
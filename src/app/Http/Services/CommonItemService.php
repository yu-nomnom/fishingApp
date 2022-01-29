<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\FieldRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CommonItemService
{
    private FieldRepositoryInterface $fieldRepository;

    /**
     * @var FieldRepositoryInterface $fieldRepository
     */
    public function __construct(FieldRepositoryInterface $fieldRepository)
    {
        $this->fieldRepository = $fieldRepository;
    }
    /**
     * 釣り場リストの取得
     * @return array $fieldList 釣り場リスト
     */
    public function getFieldList()
    {
        return $this->fieldRepository->getAllField();
    }
    
}
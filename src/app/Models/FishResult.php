<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishResult extends Model
{
    protected $table = 'fish_results';
    protected $guarded = 'id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
}

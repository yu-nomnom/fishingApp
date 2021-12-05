<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishingConsideration extends Model
{
    protected $table = 'fishing_consideration';
    protected $guarded = 'id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
}

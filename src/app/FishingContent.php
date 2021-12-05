<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishingContent extends Model
{
    protected $table = 'fishing_contents';
    protected $guarded = 'id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
}

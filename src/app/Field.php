<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'field';
    protected $guarded = 'id';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
}

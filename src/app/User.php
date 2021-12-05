<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $hidden = [
        'password'
    ];
}

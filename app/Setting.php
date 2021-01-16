<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'email',
        'logo',
        'phone',
        'address',
        'footer',
        'about',
        'facebook',
        'twitter',
        'linkedin',
    ];
}

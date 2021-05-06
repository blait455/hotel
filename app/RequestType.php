<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    protected $fillable = ['name','slug'];

    public function requisition()
    {
        return $this->belongsToMany(Requisition::class);
    }

}

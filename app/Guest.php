<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['room_id', 'name', 'email', 'phone', 'nights', 'status'];
    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}

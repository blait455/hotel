<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    protected $fillable = ['room_id', 'name'];
    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['room_id', 'user_id', 'guest_id', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function guest()
    {
        return $this->belongsTo('App\Guest');
    }

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}

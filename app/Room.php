<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['type_id', 'feature_id', 'name', 'price', 'slug', 'beds', 'floor', 'status'];
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function gallery()
    {
        return $this->hasMany(RoomImage::class);
    }
}

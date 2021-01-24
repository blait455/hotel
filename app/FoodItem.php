<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = ['food_type_id', 'name', 'price', 'slug', 'status'];
    public function type()
    {
        return $this->belongsTo(FoodType::class, 'food_type_id');
    }
    public function gallery()
    {
        return $this->hasMany(GalleryImage::class);
    }
}

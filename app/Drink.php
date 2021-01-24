<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = ['drink_category_id', 'name', 'price', 'slug', 'status'];
    public function type()
    {
        return $this->belongsTo(DrinkCategory::class, 'drink_category_id');
    }
    public function gallery()
    {
        return $this->hasMany(GalleryImage::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkPurchase extends Model
{
    protected $fillable = [
        'supplier_id', 'brand', 'stock_level', 'quantity', 'rate', 'amount', 'remarks'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}

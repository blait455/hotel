<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreRecord extends Model
{
    protected $fillable = [
        'record_item_id', 'opening_stock', 'supplied', 'issued', 'closing_stock', 'remark'
    ];

    public function r_item()
    {
        return $this->belongsTo(RecordItem::class, 'record_item_id');
    }
}

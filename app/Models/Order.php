<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'table_id',
        'status',
        'total_amount',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
} 
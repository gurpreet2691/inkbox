<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItems extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_item_id';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'refund',
        'resend_amount'
    ];

    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'order_id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}

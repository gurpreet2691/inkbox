<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_number',
        'customer_id',
        'total_price',
        'fulfillment_status',
        'fulfilled_date',
        'order_status',
        'customer_order_count'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrdersItems::class, 'order_id');
    }

    public function format()
    {
        return [
            'order_id' => $this->order_id,
            'order_number' => $this->order_number,
            'customer_id' => $this->customer_id,
            'total_price' => $this->total_price,
            'fulfillment_status' => $this->fulfillment_status,
            'order_status' => $this->order_status
        ];
    }

}

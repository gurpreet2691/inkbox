<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id',
        'title',
        'vendor',
        'type',
        'size',
        'price',
        'handle',
        'inventory_quantity',
        'sku',
        'design_url',
        'published_state',
        'created_at',
        'updated_at',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrdersItems::class, 'product_id');
    }

    public function format()
    {
        return [
            'id' => $this->product_id,
            'title' => $this->title,
            'size' => $this->size,
            'price' => $this->price,
            'order_items_id' => $this->orderItems()
        ];
    }
}

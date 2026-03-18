<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'total_amount',
        'status',
        'shipping_address',
        'payment_method',
        'payment_id',
        'payment_status',
        'phone',
        'delivered_at',
        'transaction_id',
        'placed_at',
        'processing_at',
        'shipped_at',
        'delivered_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

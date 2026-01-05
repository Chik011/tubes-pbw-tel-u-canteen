<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_url',
        'delivery_type',
        'delivery_address',
    ];

    /**
     * Relasi: 1 Order punya banyak item (keranjang)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi: 1 Order dimiliki oleh 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

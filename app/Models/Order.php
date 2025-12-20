<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    /**
     * Relasi: 1 Order punya banyak item (keranjang)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

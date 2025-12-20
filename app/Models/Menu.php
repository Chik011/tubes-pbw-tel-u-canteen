<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    // Relasi ke order items (keranjang)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

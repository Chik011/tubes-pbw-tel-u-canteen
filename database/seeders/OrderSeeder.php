<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user & produk random
        $userId = DB::table('users')->inRandomOrder()->value('id');
        $products = DB::table('products')->inRandomOrder()->limit(3)->get();

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'order_code' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $products->sum(fn ($p) => $p->price),
            'status' => 'checkout', // pending | checkout | paid | shipped
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($products as $product) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'qty' => 1,
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

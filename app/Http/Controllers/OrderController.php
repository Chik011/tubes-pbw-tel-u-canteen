<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Halaman menu & keranjang
     */
    public function index()
    {
        $menus = Menu::all();

        // Ambil keranjang (belum checkout)
        $order = Order::where('status', 'cart')
            ->with('items.menu')
            ->first();

        return view('order', compact('menus', 'order'));
    }

    /**
     * Tambah menu ke keranjang
     */
    public function addToCart(Menu $menu)
    {
        // Ambil / buat keranjang
        $order = Order::firstOrCreate(
            ['status' => 'cart'],
            [
                'user_id' => auth()->id(),
                'total_price' => 0,
            ]
        );

        // Cek item sudah ada
        $item = OrderItem::where('order_id', $order->id)
            ->where('menu_id', $menu->id)
            ->first();

        if ($item) {
            $item->increment('qty');
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'qty' => 1,
                'price' => $menu->price,
            ]);
        }

        // Hitung ulang total harga
        $order->total_price = $order->items->sum(function ($item) {
            return $item->qty * $item->price;
        });

        $order->save();

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang');
    }

    /**
     * Checkout pesanan
     */
    public function checkout()
    {
        $order = Order::where('status', 'cart')->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Keranjang masih kosong');
        }

        $order->update([
            'status' => 'paid',
        ]);

        return redirect('/order')->with('success', 'Pesanan berhasil checkout!');
    }
}
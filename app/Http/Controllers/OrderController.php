<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Midtrans\Transaction;

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
    public function checkout(Request $request) {
        $order = Order::where('status', 'cart')
            ->where('user_id', auth()->id())
            ->with('items.menu')
            ->first();

        if (!$order || $order->items->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang masih kosong');
        }

        // Validasi delivery
        $deliveryType = $request->delivery_type ?? 'pickup';
        
        if ($deliveryType === 'delivery') {
            $request->validate([
                'delivery_address' => 'required|string',
            ], [
                'delivery_address.required' => 'Silakan pilih alamat delivery.',
            ]);
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => $item->menu_id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'name' => $item->menu->name,
                ];
            })->toArray(),
            'callbacks' => [
                'finish_redirect_url' => route('payment.return'),
            ],
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        $order->update([
            'status' => 'pending',
            'payment_url' => $paymentUrl,
            'delivery_type' => $deliveryType,
            'delivery_address' => $deliveryType === 'delivery' ? $request->delivery_address : null,
        ]);

        return redirect()->route('history')->with('success', 'Pesanan dibuat! Silakan klik Bayar untuk menyelesaikan pembayaran.');
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notif = new Notification();

        $orderId = str_replace('ORDER-', '', $notif->order_id);
        $status = $notif->transaction_status;

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($status === 'settlement' || $status === 'capture') {
            $order->update(['status' => 'paid']);
        } elseif ($status === 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($status === 'deny' || $status === 'cancel') {
            $order->update(['status' => 'cancelled']);
        } elseif ($status === 'expire') {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Handle return from Midtrans after payment
     */
    public function paymentReturn(Request $request)
    {
        $orderId = $request->order_id;
        $status = $request->transaction_status;

        if ($orderId) {
            $orderId = str_replace('ORDER-', '', $orderId);
            $order = Order::find($orderId);

            if ($order) {
                if ($status === 'settlement') {
                    $order->update(['status' => 'paid']);
                } elseif ($status === 'pending') {
                    $order->update(['status' => 'pending']);
                } elseif ($status === 'cancel' || $status === 'expire') {
                    $order->update(['status' => 'cancelled']);
                } elseif ($status === 'deny') {
                    $order->update(['status' => 'failed']);
                }

                return redirect()->route('history')->with('success', 'Pembayaran berhasil! Status: ' . $status);
            }
        }

        return redirect()->route('history')->with('info', 'Silakan periksa status pembayaran di halaman riwayat.');
    }

    /**
     * Manual payment status check for users
     */
    public function manualCheckStatus(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;

        try {
            $statusResponse = Transaction::status('ORDER-' . $order->id);
            $transactionStatus = $statusResponse->transaction_status;

            if ($transactionStatus === 'settlement') {
                $order->update(['status' => 'paid']);
                return redirect()->route('history')->with('success', 'Pembayaran berhasil! Status: Paid');
            } elseif ($transactionStatus === 'pending') {
                return redirect()->route('history')->with('info', 'Pembayaran masih pending. Silakan selesaikan pembayaran.');
            } elseif (in_array($transactionStatus, ['cancel', 'expire'])) {
                $order->update(['status' => 'cancelled']);
                return redirect()->route('history')->with('error', 'Pembayaran dibatalkan atau expired.');
            } elseif ($transactionStatus === 'deny') {
                $order->update(['status' => 'failed']);
                return redirect()->route('history')->with('error', 'Pembayaran ditolak.');
            }

            return redirect()->route('history')->with('info', 'Status: ' . $transactionStatus);
        } catch (\Exception $e) {
            return redirect()->route('history')->with('error', 'Gagal memeriksa status: ' . $e->getMessage());
        }
    }

    /**
     * Generate payment URL for existing pending orders
     */
    public function generatePaymentUrl(Order $order)
    {
        // Ensure order belongs to authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya pesanan dengan status pending yang dapat dibayar.');
        }

        $order->load('items.menu');

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => $item->menu_id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'name' => $item->menu->name,
                ];
            })->toArray(),
            'callbacks' => [
                'finish_redirect_url' => route('payment.return'),
            ],
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        $order->update([
            'payment_url' => $paymentUrl,
        ]);

        return redirect($paymentUrl);
    }

    /**
     * Check and update payment status from Midtrans
     */
    public function checkPaymentStatus(Order $order)
    {
        // Ensure order belongs to authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $status = Transaction::status('ORDER-' . $order->id);
            $transactionStatus = $status->transaction_status;

            if ($transactionStatus === 'settlement') {
                $order->update(['status' => 'paid']);
            } elseif ($transactionStatus === 'pending') {
                $order->update(['status' => 'pending']);
            } elseif (in_array($transactionStatus, ['cancel', 'expire'])) {
                $order->update(['status' => 'cancelled']);
            } elseif ($transactionStatus === 'deny') {
                $order->update(['status' => 'failed']);
            }

            return redirect()->route('history')->with('success', 'Status pembayaran diperbarui: ' . $transactionStatus);
        } catch (\Exception $e) {
            return redirect()->route('history')->with('error', 'Gagal memeriksa status pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Complete/finish an order (for admin)
     */
    public function completeOrder(Order $order)
    {
        // Only admin can complete orders
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if (!in_array($order->status, ['pending', 'paid'])) {
            return redirect()->back()->with('error', 'Pesanan tidak dapat diselesaikan.');
        }

        $order->update(['status' => 'completed']);

        return redirect()->route('admin.dashboard')->with('success', 'Pesanan #' . $order->id . ' telah diselesaikan.');
    }
}

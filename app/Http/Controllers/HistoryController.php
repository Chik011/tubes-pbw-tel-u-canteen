<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu', 'user')
            ->where('user_id', auth()->id())
            ->get();
        return view('history', compact('orders'));
    }
}

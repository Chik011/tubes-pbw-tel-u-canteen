<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu')->get();
        return view('admin.history', compact('orders'));
    }
}

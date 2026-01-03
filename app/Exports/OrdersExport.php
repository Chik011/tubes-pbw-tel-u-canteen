<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::with('items.menu', 'user')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Email',
            'Total',
            'Status',
            'Pengambilan',
            'Alamat',
            'Items',
            'Tanggal',
        ];
    }

    /**
     * @param mixed $order
     * @return array
     */
    public function map($order): array
    {
        $items = $order->items->map(function ($item) {
            return $item->menu->name . ' (' . $item->qty . 'x Rp ' . number_format($item->price, 0, ',', '.') . ')';
        })->implode(', ');

        return [
            $order->id,
            $order->user ? $order->user->name : 'Unknown',
            $order->user ? $order->user->email : 'N/A',
            'Rp ' . number_format($order->total_price, 0, ',', '.'),
            $order->status,
            $order->delivery_type === 'delivery' ? 'Delivery' : 'Ambil di Tempat',
            $order->delivery_address ?? '-',
            $items,
            $order->created_at->format('d/m/Y H:i'),
        ];
    }
}


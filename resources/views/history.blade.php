<x-layout>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-title {
            font-weight: bold;
            color: #dc3545;
        }

        .history-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
    </style>

    <div class="container my-5">
        <h1 class="text-center mb-5 page-title">Riwayat Pesanan</h1>

        @if($orders->count())
            <div class="card history-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Pengambilan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @foreach($order->items as $item)
                                        <span class="badge bg-light text-dark mb-1">
                                            {{ $item->menu->name }} ({{ $item->qty }}x)
                                        </span>
                                        @endforeach
                                    </td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($order->delivery_type === 'delivery')
                                            <span class="badge bg-primary">Delivery</span>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($order->delivery_address, 30) }}</small>
                                        @else
                                            <span class="badge bg-secondary">Ambil di Tempat</span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($order->status)
                                            @case('pending')
                                                <div class="d-flex gap-2 align-items-center">
                                                    @if($order->payment_url)
                                                        <a href="{{ $order->payment_url }}" target="_blank" class="btn btn-primary btn-sm">Bayar</a>
                                                    @else
                                                        <form action="{{ route('order.payment', $order->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary btn-sm">Bayar</button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('order.check-status', $order->id) }}" class="btn btn-outline-secondary btn-sm" title="Perbarui Status">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </a>
                                                </div>
                                                @break
                                            @case('paid')
                                                <span class="badge bg-info">Sudah Dibayar</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success">Selesai</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                                @break
                                            @case('failed')
                                                <span class="badge bg-danger">Gagal</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">Belum ada pesanan</p>
                <a href="{{ route('order') }}" class="btn btn-danger">Pesan Sekarang</a>
            </div>
        @endif
    </div>
</x-layout>


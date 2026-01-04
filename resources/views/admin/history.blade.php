<x-layout>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-title {
            font-weight: bold;
            color: #dc3545;
        }

        .admin-card {
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title">Kelola Pesanan</h1>
            <div>
                <a href="{{ route('admin.menus') }}" class="btn btn-danger px-4">
                    🍽️ Kelola Menu
                </a>
                <a href="{{ route('admin.orders.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>
        </div>

        @if($orders->count())
            <div class="card admin-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Pengambilan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>
                                        {{ $order->user ? $order->user->name : 'Unknown' }}
                                        <br>
                                        <small class="text-muted">{{ $order->user ? $order->user->email : '' }}</small>
                                    </td>
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
                                            @case('cart')
                                                <span class="badge bg-secondary">Keranjang</span>
                                                @break
                                            @case('pending')
                                                <span class="badge bg-warning">Menunggu Pembayaran</span>
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
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($order->status === 'paid')
                                            <form action="{{ route('order.complete', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin menyelesaikan pesanan ini?')">
                                                    <i class="fas fa-check"></i> Selesai
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">Belum Selesai</span>
                                        @endif
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
            </div>
        @endif
    </div>
</x-layout>


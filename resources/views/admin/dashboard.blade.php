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

        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }

        .badge-paid {
            background-color: #28a745;
            color: #fff;
        }

        .badge-cancelled {
            background-color: #dc3545;
            color: #fff;
        }
    </style>

    <div class="container my-5">
        <h1 class="text-center mb-5 page-title">Dashboard Admin</h1>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->count())
            <div class="card admin-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Pengambilan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>{{ $order->user ? $order->user->name : 'Unknown' }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($order->delivery_type === 'delivery')
                                            <span class="badge bg-primary">Delivery</span>
                                            <br>
                                            <small class="text-muted">{{ $order->delivery_address }}</small>
                                        @else
                                            <span class="badge bg-secondary">Ambil di Tempat</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                            Detail
                                        </button>
                                        
                                        @if($order->status === 'pending')
                                            <form action="{{ route('order.complete', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pesanan?')">
                                                    Selesai
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                
                                <!-- Modal Detail -->
                                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #dc3545; color: white;">
                                                <h5 class="modal-title">Detail Pesanan #{{ $order->id }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Pelanggan:</strong> {{ $order->user ? $order->user->name : 'Unknown' }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Email:</strong> {{ $order->user ? $order->user->email : '-' }}
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Tipe Pengambilan:</strong> 
                                                        {{ $order->delivery_type === 'delivery' ? 'Delivery' : 'Ambil di Tempat' }}
                                                    </div>
                                                    @if($order->delivery_type === 'delivery')
                                                    <div class="col-md-6">
                                                        <strong>Alamat:</strong> {{ $order->delivery_address }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Status:</strong> {{ ucfirst($order->status) }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                </div>
                                                
                                                <hr>
                                                
                                                <h6 class="fw-bold mb-3">Items:</h6>
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Menu</th>
                                                            <th>Qty</th>
                                                            <th>Harga</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->items as $item)
                                                        <tr>
                                                            <td>{{ $item->menu->name }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                            <td>Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold">Total:</td>
                                                            <td class="fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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


<x-layout>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-title {
            font-weight: bold;
            color: #dc3545;
        }

        .menu-card img {
            height: 220px;
            object-fit: cover;
        }

        .menu-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .menu-card .card-body {
            text-align: center;
        }

        .btn-outline-danger {
            font-weight: 600;
        }

        .cart-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .cart-header {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>

    <div class="container my-5">
        <h1 class="text-center mb-5 page-title">Pesan Makanan</h1>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">
            {{-- ================= MENU ================= --}}
            <div class="col-lg-8">
                <div class="row g-4">
                    @foreach ($menus as $menu)
                        <div class="col-md-6">
                            <div class="card menu-card">
                                <img
                                    src="{{ asset('img/'.$menu->image) }}"
                                    class="card-img-top"
                                    alt="{{ $menu->name }}"
                                >

                                <div class="card-body">
                                    <h5>{{ $menu->name }}</h5>
                                    <p class="text-muted">
                                        {{ $menu->description }}
                                    </p>
                                    <p class="fw-bold">
                                        Rp {{ number_format($menu->price) }}
                                    </p>

                                    <form action="/cart/add/{{ $menu->id }}" method="POST">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="btn btn-outline-danger w-100"
                                        >
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ================= KERANJANG ================= --}}
            <div class="col-lg-4">
                <div class="card cart-card sticky-top" style="top:100px;">
                    <div class="card-header cart-header">
                        🛒 Keranjang Belanja
                    </div>

                    <div class="card-body">
                        @if ($order && $order->items->count())
                            <ul class="list-group mb-3">
                                @foreach ($order->items as $item)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong>{{ $item->menu->name }}</strong>

                                            <div class="d-flex align-items-center gap-2">
                                                <button
                                                    class="btn btn-sm btn-outline-danger btn-minus"
                                                    data-id="{{ $item->id }}"
                                                >
                                                    −
                                                </button>

                                                <span class="fw-bold qty-{{ $item->id }}">
                                                    {{ $item->qty }}
                                                </span>

                                                <button
                                                    class="btn btn-sm btn-outline-danger btn-plus"
                                                    data-id="{{ $item->id }}"
                                                >
                                                    +
                                                </button>
                                            </div>
                                        </div>

                                        <small class="text-muted">
                                            Rp {{ number_format($item->price * $item->qty) }}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>

                            <h6 class="text-end fw-bold mb-3">
                                Total: Rp {{ number_format($order->total_price) }}
                            </h6>

                            <form action="/checkout" method="POST">
                                @csrf
                                <button class="btn btn-danger w-100">
                                    Checkout
                                </button>
                            </form>
                        @else
                            <p class="text-muted text-center mb-0">
                                Keranjang masih kosong
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= SCRIPT ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content');

            function sendQty(id, type) {
                fetch(`/cart/${type}/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                }).then(() => {
                    const qtyEl = document.querySelector('.qty-' + id);
                    let qty = parseInt(qtyEl.innerText);

                    if (type === 'plus') {
                        qtyEl.innerText = qty + 1;
                    } else {
                        if (qty > 1) {
                            qtyEl.innerText = qty - 1;
                        } else {
                            location.reload();
                        }
                    }
                });
            }

            document.querySelectorAll('.btn-plus').forEach(btn => {
                btn.addEventListener('click', () => {
                    sendQty(btn.dataset.id, 'plus');
                });
            });

            document.querySelectorAll('.btn-minus').forEach(btn => {
                btn.addEventListener('click', () => {
                    sendQty(btn.dataset.id, 'minus');
                });
            });
        });
    </script>
</x-layout>

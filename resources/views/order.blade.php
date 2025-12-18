
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

        <div class="row g-4">
            <!-- MENU -->
            <div class="col-lg-8">
                <div class="row g-4">

                    <!-- ITEM -->
                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/naci_oyeng.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Nasi Goreng</h5>
                                <p class="text-muted">Nasi goreng spesial dengan telur dan ayam.</p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Nasi Goreng', 18000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/ayam_bakar.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Nasi Ayam Bakar</h5>
                                <p class="text-muted">Ayam bakar dengan bumbu rempah.</p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Nasi Ayam Bakar', 18000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/sate_ayam.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Sate Ayam</h5>
                                <p class="text-muted">Sate ayam dengan bumbu kacang.</p>
                                <p class="fw-bold">Rp 25.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Sate Ayam', 25000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/bakso.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Bakso</h5>
                                <p class="text-muted">Bakso daging sapi dengan mie.</p>
                                <p class="fw-bold">Rp 15.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Bakso', 15000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/ayam_oyeng.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Nasi Ayam Goreng</h5>
                                <p class="text-muted">Ayam Goreng enakk</p>
                                <p class="fw-bold">Rp 15.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Ayam Goreng', 15000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/soto_ayam.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Soto Ayam</h5>
                                <p class="text-muted">Soto Ayam</p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Soto Ayam', 18000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/gado.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Gado-Gado</h5>
                                <p class="text-muted">Gado Gado </p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Gado-Gado', 18000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/mi_ayam.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Mie Ayam</h5>
                                <p class="text-muted">Mie Ayam</p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Mie Ayam', 18000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/mie_goreng.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Mie Goreng Telur</h5>
                                <p class="text-muted">Mie Goreng</p>
                                <p class="fw-bold">Rp 10.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Mie Goreng', 10000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/rendang.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Rendang</h5>
                                <p class="text-muted">Rendang</p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100"
                                onclick="addToCart('Rendang', 18000)">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- KERANJANG -->
            <div class="col-lg-4">
                <div class="card cart-card sticky-top" style="top:100px;">
                    <div class="card-header cart-header">
                        🛒 Keranjang Belanja
                    </div>

            <div class="card-body">
            <ul class="list-group mb-3" id="cart-items">
                <li class="list-group-item text-muted text-center">
                    Keranjang masih kosong
                </li>
            </ul>

                <h6 class="text-end mb-3">
                Total: <span id="cart-total">Rp 0</span>
                  </h6>

             <button class="btn btn-outline-danger w-100" id="checkout-btn" disabled>
                Checkout
             </button>
            </div>

                        <small class="d-block mt-2 text-muted">
                            Tambahkan menu untuk melanjutkan
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
let cart = [];

function addToCart(name, price) {
    const item = cart.find(i => i.name === name);

    if (item) {
        item.qty++;
    } else {
        cart.push({ name, price, qty: 1 });
    }

    renderCart();
}

function increaseQty(name) {
    cart.find(i => i.name === name).qty++;
    renderCart();
}

function decreaseQty(name) {
    const item = cart.find(i => i.name === name);
    item.qty--;

    if (item.qty <= 0) {
        cart = cart.filter(i => i.name !== name);
    }

    renderCart();
}

function renderCart() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');

    cartItems.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
        cartItems.innerHTML = `
            <li class="list-group-item text-muted text-center">
                Keranjang masih kosong
            </li>`;
        cartTotal.innerText = 'Rp 0';
        checkoutBtn.disabled = true;
        return;
    }

    cart.forEach(item => {
        const subtotal = item.price * item.qty;
        total += subtotal;

        cartItems.innerHTML += `
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <strong>${item.name}</strong>
                    <span>Rp ${subtotal.toLocaleString()}</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <div>
                        <button class="btn btn-sm btn-outline-danger" onclick="decreaseQty('${item.name}')">−</button>
                        <span class="mx-2">${item.qty}</span>
                        <button class="btn btn-sm btn-outline-danger" onclick="increaseQty('${item.name}')">+</button>
                    </div>
                    <small class="text-muted">
                        Rp ${item.price.toLocaleString()} / item
                    </small>
                </div>
            </li>
        `;
    });

    cartTotal.innerText = 'Rp ' + total.toLocaleString();
    checkoutBtn.disabled = false;
}
</script>

</x-layout>

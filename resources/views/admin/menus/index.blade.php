<x-layout>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-title {
            font-weight: bold;
            color: #dc3545;
        }

        .menu-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background-color: #dc3545;
            color: white;
        }
    </style>

    <div class="container my-5">
        <h1 class="text-center mb-5 page-title">Kelola Menu</h1>

        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('admin.menus.create') }}" class="btn btn-danger">
                <i class="fas fa-plus"></i> Tambah Menu
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($menus->count())
            <div class="card menu-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $index => $menu)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $menu->name }}</strong></td>
                                    <td>{{ $menu->description }}</td>
                                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($menu->image)
                                            <img src="{{ asset('img/' . $menu->image) }}" alt="{{ $menu->name }}" width="80" style="border-radius: 8px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
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
                <p class="text-muted">Belum ada menu tersedia</p>
            </div>
        @endif
    </div>
</x-layout>


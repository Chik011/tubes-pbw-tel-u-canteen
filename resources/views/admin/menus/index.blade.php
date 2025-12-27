@extends('components.layout')

@section('content')
<div class="container">
    <h1>Manage Menus</h1>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary mb-3">Add New Menu</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->description }}</td>
                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                <td>
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="50">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

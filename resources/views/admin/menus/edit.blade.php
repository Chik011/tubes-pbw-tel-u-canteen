<x-layout>
    <div class="container">
        <h1>Edit Menu</h1>
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $menu->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $menu->price }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @if($menu->image)
                    <img src="{{ asset('img/' . $menu->image) }}" alt="{{ $menu->name }}" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Menu</button>
            <a href="{{ route('admin.menus') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-layout>

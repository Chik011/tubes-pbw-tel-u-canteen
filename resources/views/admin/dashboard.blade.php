<x-layout>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Menus</h5>
                        <p class="card-text">Add, edit, or delete food menus.</p>
                        <a href="{{ route('admin.menus') }}" class="btn btn-primary">Go to Menus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order History</h5>
                        <p class="card-text">View all order history.</p>
                        <a href="{{ route('admin.history') }}" class="btn btn-primary">Go to History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

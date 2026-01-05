@extends('admin.layouts.master')

@section('title', 'Manage Products')

@section('content')
<div class="content-header">
    <h2>Manage Products</h2>

    <!-- Add Product Button -->
    <button class="btn btn-primary"
        onclick="document.getElementById('addProductForm').style.display='block'">
        + Add Product
    </button>
</div>

<!-- Add Product Form -->
<div id="addProductForm" style="display:none; margin:20px 0;">
    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Product Name" required>

        <select name="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <input type="number" name="price" placeholder="Price" required>

        <button class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary"
            onclick="document.getElementById('addProductForm').style.display='none'">
            Cancel
        </button>
    </form>
</div>

@if($products->count() === 0)
    <!-- Empty State -->
    <div class="empty-box">
        <p>No products available.</p>
        <p>Please add a new product.</p>
    </div>
@else
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Category</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $prod)
        <tr>
            <td>{{ $prod->id }}</td>
            <td>{{ $prod->name }}</td>
            <td>{{ $prod->category->name ?? '-' }}</td>
            <td>₹ {{ $prod->price }}</td>
            <td>
                <form method="POST" action="{{ route('admin.products.destroy', $prod->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this product?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection

@extends('admin.layouts.master')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')
@section('page-description', 'Create a new product')

@section('content')
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Add New Product</h3>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Product Name *</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="category_id">Category *</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price (₹) *</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" min="0">
                </div>
            </div>
            
            <div class="form-group">
                <label for="hsn_code">HSN Code</label>
                <input type="text" name="hsn_code" id="hsn_code" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
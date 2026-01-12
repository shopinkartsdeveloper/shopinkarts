@extends('admin.layouts.master')

@section('title', 'Product Details')
@section('page-title', 'Product Details')
@section('page-description', 'View complete product information')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/product.css') }}">
@endsection

@section('content')
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Product Details</h3>
        
        <div class="action-buttons">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Product
            </a>
            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" 
                  style="display: inline;" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete Product
                </button>
            </form>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>
    </div>

    <div class="product-details-container">
        <div class="product-info-grid">
            <!-- Product Basic Info -->
            <div class="info-card">
                <h4><i class="fas fa-info-circle"></i> Basic Information</h4>
                <div class="info-item">
                    <span class="info-label">Product ID:</span>
                    <span class="info-value">#{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Product Name:</span>
                    <span class="info-value">{{ $product->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Slug:</span>
                    <span class="info-value">{{ $product->slug ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Category:</span>
                    <span class="info-value">{{ $product->category->name ?? 'Uncategorized' }}</span>
                </div>
            </div>

            <!-- Product Pricing -->
            <div class="info-card">
                <h4><i class="fas fa-tag"></i> Pricing Information</h4>
                <div class="info-item">
                    <span class="info-label">Price:</span>
                    <span class="info-value price">₹ {{ number_format($product->price, 2) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">HSN Code:</span>
                    <span class="info-value">{{ $product->hsn ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span class="info-value status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <!-- Stock Information -->
            <div class="info-card">
                <h4><i class="fas fa-box"></i> Stock Information</h4>
                <div class="info-item">
                    <span class="info-label">Stock Quantity:</span>
                    <span class="info-value">{{ $product->stock_quantity ?? 0 }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Stock Status:</span>
                    <span class="info-value">
                        @php
                            $stockQty = $product->stock_quantity ?? 0;
                            if($stockQty > 10) {
                                echo '<span class="stock-status in-stock">In Stock</span>';
                            } elseif($stockQty > 0 && $stockQty <= 10) {
                                echo '<span class="stock-status low-stock">Low Stock</span>';
                            } else {
                                echo '<span class="stock-status out-of-stock">Out of Stock</span>';
                            }
                        @endphp
                    </span>
                </div>
            </div>

            <!-- Dates Information -->
            <div class="info-card">
                <h4><i class="fas fa-calendar-alt"></i> Date Information</h4>
                <div class="info-item">
                    <span class="info-label">Created At:</span>
                    <span class="info-value">{{ $product->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Updated At:</span>
                    <span class="info-value">{{ $product->updated_at->format('d M Y, h:i A') }}</span>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        @if($product->description)
        <div class="description-card">
            <h4><i class="fas fa-file-alt"></i> Product Description</h4>
            <div class="description-content">
                {{ $product->description }}
            </div>
        </div>
        @endif

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h4><i class="fas fa-bolt"></i> Quick Actions</h4>
            <div class="action-buttons-grid">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn edit">
                    <i class="fas fa-edit"></i> Edit Product
                </a>
                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" 
                      onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete">
                        <i class="fas fa-trash"></i> Delete Product
                    </button>
                </form>
                <a href="#" class="action-btn view" onclick="duplicateProduct({{ $product->id }})">
                    <i class="fas fa-copy"></i> Duplicate
                </a>
                <a href="{{ route('admin.products.index') }}" class="action-btn back">
                    <i class="fas fa-list"></i> All Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this product? This action cannot be undone.');
    }
    
    function duplicateProduct(productId) {
        if(confirm('Create a duplicate of this product?')) {
            // You can implement AJAX duplicate functionality here
            alert('Duplicate functionality would be implemented here.');
        }
    }
    
    // Auto-hide success/error messages after 5 seconds
    @if(session('success') || session('error'))
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    @endif
</script>
@endsection
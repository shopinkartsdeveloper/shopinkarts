@extends('admin.layouts.master')

@section('title', 'Deleted Products')
@section('page-title', 'Deleted Products')
@section('page-description', 'Restore or permanently delete products')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/product.css') }}">
@endsection

@section('content')
    <!-- Flash Messages -->
    <div class="flash-messages">
        @if(session('success'))
            <div class="flash-message success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="flash-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="flash-message error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button type="button" class="flash-close" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Deleted Products Table Section -->
    <div class="data-table-section">
        <div class="section-title-bar">
            <h3 class="section-title">Deleted Products (Trash)</h3>
            
            <div class="search-filter-bar">
                <a href="{{ route('admin.products.index') }}" class="filter-btn">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
        
        @if($trashedProducts->count() === 0)
            <!-- Empty Trash State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h3>Trash is Empty</h3>
                <p>No deleted products found.</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        @else
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>P. ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Deleted At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trashedProducts as $product)
                    <tr>
                        <td>#{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="product-name">{{ $product->name }}</div>
                        </td>
                        <td class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</td>
                        <td class="product-price">₹ {{ number_format($product->price, 2) }}</td>
                        <td class="deleted-date">{{ $product->deleted_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <div class="action-icons">
                                <!-- Restore Button -->
                                <form method="POST" action="{{ route('admin.products.restore', $product->id) }}" 
                                      style="display: inline;" onsubmit="return confirm('Restore this product?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-icon restore" title="Restore">
                                        <i class="fas fa-trash-restore"></i>
                                    </button>
                                </form>
                                
                                <!-- Permanent Delete Button -->
                                <form method="POST" action="{{ route('admin.products.force-delete', $product->id) }}" 
                                      style="display: inline;" 
                                      onsubmit="return confirm('Permanently delete this product? This cannot be undone!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon permanent-delete" title="Delete Permanently">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination">
            <div class="pagination-info">
                Showing {{ $trashedProducts->firstItem() }} to {{ $trashedProducts->lastItem() }} of {{ $trashedProducts->total() }} entries
            </div>
            
            <div class="pagination-controls">
                {{ $trashedProducts->links('vendor.pagination.custom') }}
            </div>
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    // Auto-hide messages after 5 seconds
    setTimeout(() => {
        const messages = document.querySelectorAll('.flash-message');
        messages.forEach(msg => {
            msg.style.transition = 'opacity 0.5s';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        });
    }, 5000);
</script>
@endsection
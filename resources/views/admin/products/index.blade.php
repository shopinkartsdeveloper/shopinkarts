@extends('admin.layouts.master')

@section('title', 'Manage Products')
@section('page-title', 'Admin Products Screen 1')
@section('page-description', 'Manage Products Data Table')
@section('page-subtitle', 'Admin Products')

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

    <!-- Products Data Table Section -->
    <div class="data-table-section">
        <div class="section-title-bar">
            <h3 class="section-title">All Products</h3>
            
            <div class="search-filter-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search products..." id="searchInput">
                </div>

                <!-- Trash Button -->
                <a href="/admin/products/trash" class="filter-btn trash-btn">
                    <i class="fas fa-trash-restore"></i> View Trash
                </a>
                
                <!-- Add Product Button -->
                <a href="{{ route('admin.products.create') }}" class="filter-btn add-btn">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        </div>
        
        @if($products->count() === 0)
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>No Products Found</h3>
                <p>There are no products in your store yet.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Your First Product
                </a>
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>P. ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @foreach($products as $prod)
                        <tr class="product-row" data-name="{{ strtolower($prod->name) }}" data-category="{{ strtolower($prod->category->name ?? '') }}">
                            <td class="product-id">#{{ str_pad($prod->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="product-image">
                                    @if($prod->image)
                                        <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}">
                                    @else
                                        <i class="fas fa-image"></i>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="product-name">{{ $prod->name }}</div>
                                @if($prod->description)
                                    <div class="product-description">{{ Str::limit($prod->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="product-category">
                                <span class="category-badge">{{ $prod->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td class="product-price">₹ {{ number_format($prod->price, 2) }}</td>
                            <td>
                                @php
                                    $stockQty = $prod->stock_quantity ?? 0;
                                    $stockClass = 'stock-normal';
                                    if($stockQty == 0) {
                                        $stockClass = 'stock-out';
                                    } elseif($stockQty <= 10) {
                                        $stockClass = 'stock-low';
                                    }
                                @endphp
                                <span class="stock-badge {{ $stockClass }}">
                                    {{ $stockQty }} in stock
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusClass = $prod->is_active ? 'status-active' : 'status-inactive';
                                    $statusText = $prod->is_active ? 'Active' : 'Inactive';
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('admin.products.show', $prod->id) }}" class="action-icon view" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $prod->id) }}" class="action-icon edit" title="Edit Product">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $prod->id) }}" 
                                        style="display: inline;" 
                                        onsubmit="return confirm('Are you sure you want to delete \"{{ $prod->name }}\"?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-icon delete" title="Delete Product">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <div class="pagination-info">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                </div>
                
                <div class="pagination-controls">
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
            </div>
        @endif
    </div>
    
    <!-- Product Statistics -->
    <div class="data-table-section stats-section">
        <div class="section-title-bar">
            <h3 class="section-title">Product Statistics</h3>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $totalProducts }}</div>
                    <div class="stat-label">Total Products</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon in-stock">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $inStockProducts }}</div>
                    <div class="stat-label">In Stock</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon low-stock">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $lowStockProducts }}</div>
                    <div class="stat-label">Low Stock</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon categories">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $totalCategories }}</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activities -->
    <div class="data-table-section activities-section">
        <div class="section-title-bar">
            <h3 class="section-title">Recent Product Activities</h3>
        </div>
        <div class="activities-list">
            @foreach($recentActivities as $activity)
            <div class="activity-item">
                <div class="activity-icon" style="background-color: {{ $activity['color'] }}20;">
                    <i class="fas fa-{{ $activity['icon'] }}" style="color: {{ $activity['color'] }};"></i>
                </div>
                <div class="activity-details">
                    <div class="activity-title">{{ $activity['title'] }}</div>
                    <div class="activity-description">{{ $activity['description'] }}</div>
                </div>
                <div class="activity-time">{{ $activity['time'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/js/product.js') }}"></script>
    <script>
        // Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            const messages = document.querySelectorAll('.flash-message');
            messages.forEach(msg => {
                msg.style.transition = 'opacity 0.5s';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500);
            });
        }, 5000);

        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.product-row');
            
            rows.forEach(row => {
                const productName = row.getAttribute('data-name');
                const productCategory = row.getAttribute('data-category');
                
                if (searchTerm === '' || 
                    productName.includes(searchTerm) || 
                    productCategory.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Update pagination info
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            const paginationInfo = document.querySelector('.pagination-info');
            if (paginationInfo && searchTerm !== '') {
                paginationInfo.textContent = `Showing 1 to ${visibleRows.length} of ${visibleRows.length} entries (filtered)`;
            }
        });

        // Quick actions
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effects to action buttons
            const actionIcons = document.querySelectorAll('.action-icon');
            actionIcons.forEach(icon => {
                icon.addEventListener('click', function(e) {
                    // Add ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.7);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        top: ${y}px;
                        left: ${x}px;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
@extends('admin.layouts.master')

@section('title', 'Manage Sellers')
@section('page_title', 'Manage Sellers')
@section('page_subtitle', 'Manage seller data and settings')

@section('content')
<!-- Seller Data Table Section -->
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Manage Seller Data Table</h3>
        
        <div class="search-filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search sellers..." id="searchInput">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
                
                <a href="{{ route('admin.sellers.create') }}" class="filter-btn" style="background-color: #28a745;">
                    <i class="fas fa-plus"></i>
                    Add New Seller
                </a>
            </div>
        </div>
    </div>
    
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #28a745;">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #e53935;">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name of Seller</th>
                    <th>Contact Info</th>
                    <th>Status</th>
                    <th>Last Updated On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sellerTableBody">
                @forelse($sellers as $index => $seller)
                <tr @if($seller->trashed()) style="opacity: 0.7; background-color: #f8d7da;" @endif>
                    <td>{{ $index + 1 }}.</td>
                    <td>
                        <div class="seller-name">{{ $seller->first_name }} {{ $seller->last_name }}</div>
                        <div class="seller-company">({{ $seller->firm_name }})</div>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: #666;">
                            {{ $seller->email }}<br>
                            {{ $seller->mobile_number }}
                        </div>
                    </td>
                    <td>
                        @if($seller->trashed())
                            <span style="color: #e53935; font-weight: 600;">Deleted</span>
                        @elseif($seller->status == 'active')
                            <span style="color: #28a745; font-weight: 600;">Active</span>
                        @elseif($seller->status == 'inactive')
                            <span style="color: #6c757d; font-weight: 600;">Inactive</span>
                        @else
                            <span style="color: #ff9800; font-weight: 600;">Pending</span>
                        @endif
                    </td>
                    <td class="last-updated">{{ $seller->updated_at->format('d-m-Y H:i A') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.sellers.show', $seller->id) }}" class="action-btn view-seller-btn" data-id="{{ $seller->id }}">
                                <i class="fas fa-eye"></i>
                                View
                            </a>
                            
                            <a href="{{ route('admin.sellers.show', $seller->id) }}" class="action-btn" style="background-color: #ff9800;">
                                <i class="fas fa-cog"></i>
                                Manage
                            </a>
                            
                            @if($seller->trashed())
                                <form action="{{ route('admin.sellers.restore', $seller->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn" style="background-color: #28a745;">
                                        <i class="fas fa-undo"></i>
                                        Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.sellers.force-delete', $seller->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" style="background-color: #e53935;" 
                                            onclick="return confirm('Permanently delete this seller? This cannot be undone!')">
                                        <i class="fas fa-trash-alt"></i>
                                        Delete
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.sellers.edit', $seller->id) }}" class="action-btn" style="background-color: #4361ee;">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.sellers.destroy', $seller->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" style="background-color: #e53935;" 
                                            onclick="return confirm('Are you sure you want to delete this seller?')">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px;">
                        <div style="color: #666; font-size: 16px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 48px; color: #ddd; margin-bottom: 15px; display: block;"></i>
                            No sellers found.
                            <br>
                            <a href="{{ route('admin.sellers.create') }}" style="color: #4361ee; text-decoration: none; margin-top: 10px; display: inline-block;">
                                <i class="fas fa-plus"></i> Add your first seller
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        <div class="pagination-info">
            Showing {{ $sellers->count() }} of {{ $sellers->count() }} entries
        </div>
    </div>
</div>

<!-- Seller Statistics -->
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Seller Statistics</h3>
    </div>
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Total Sellers</h3>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-value">{{ $totalSellers }}</div>
            <div class="stat-change">+{{ $pendingSellers }} pending</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Active Sellers</h3>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $activeSellers }}</div>
            <div class="stat-change">Active</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Inactive Sellers</h3>
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $inactiveSellers }}</div>
            <div class="stat-change negative">Inactive</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Pending Approvals</h3>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">{{ $pendingSellers }}</div>
            <div class="stat-change">Pending</div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        text-decoration: none;
        color: white;
    }
    
    .view-seller-btn {
        background-color: #4361ee;
    }
    
    form button.action-btn {
        font-size: 12px;
        padding: 6px 12px;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .filter-btn {
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        font-size: 14px;
    }
    
    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const sellerTableBody = document.getElementById('sellerTableBody');
        
        if (searchInput && sellerTableBody) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = sellerTableBody.querySelectorAll('tr');
                let visibleCount = 0;
                
                rows.forEach((row, index) => {
                    const rowText = row.textContent.toLowerCase();
                    if (rowText.includes(searchTerm)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Update pagination info
                const paginationInfo = document.querySelector('.pagination-info');
                if (paginationInfo) {
                    paginationInfo.textContent = `Showing 1 to ${visibleCount} of ${visibleCount} entries`;
                }
            });
        }
        
        // Delete confirmation
        document.querySelectorAll('form[action*="destroy"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this seller?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Force delete confirmation
        document.querySelectorAll('form[action*="force-delete"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Permanently delete this seller? This action cannot be undone!')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
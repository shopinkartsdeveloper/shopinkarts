@extends('admin.layouts.master')

@section('title', 'Manage Manufacturers')
@section('page_title', 'Manage Manufacturers')
@section('page_subtitle', 'Manage manufacturer data and settings')

@section('content')
<!-- Manufacturer Data Table Section -->
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Manage Manufacturer Data Table</h3>
        
        <div class="search-filter-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search manufacturers..." id="searchInput">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Filter
                </button>
                
                <a href="{{ route('admin.manufacturers.create') }}" class="filter-btn" style="background-color: #28a745;">
                    <i class="fas fa-plus"></i>
                    Add New Manufacturer
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
                    <th>Name of Manufacturer</th>
                    <th>Contact Info</th>
                    <th>Status</th>
                    <th>Last Updated On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="manufacturerTableBody">
                @forelse($manufacturers as $index => $manufacturer)
                <tr @if($manufacturer->trashed()) style="opacity: 0.7; background-color: #f8d7da;" @endif>
                    <td>{{ $index + 1 }}.</td>
                    <td>
                        <div class="manufacturer-name">{{ $manufacturer->first_name }} {{ $manufacturer->last_name }}</div>
                        <div class="manufacturer-company">({{ $manufacturer->firm_name }})</div>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: #666;">
                            {{ $manufacturer->email }}<br>
                            {{ $manufacturer->mobile_number }}
                        </div>
                    </td>
                    <td>
                        @if($manufacturer->trashed())
                            <span style="color: #e53935; font-weight: 600;">Deleted</span>
                        @elseif($manufacturer->status == 'active')
                            <span style="color: #28a745; font-weight: 600;">Active</span>
                        @elseif($manufacturer->status == 'inactive')
                            <span style="color: #6c757d; font-weight: 600;">Inactive</span>
                        @else
                            <span style="color: #ff9800; font-weight: 600;">Pending</span>
                        @endif
                    </td>
                    <td class="last-updated">{{ $manufacturer->updated_at->format('d-m-Y H:i A') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('admin.manufacturers.show', $manufacturer->id) }}" class="action-btn view-manufacturer-btn" data-id="{{ $manufacturer->id }}">
                                <i class="fas fa-eye"></i>
                                View
                            </a>
                            
                            <a href="{{ route('admin.manufacturers.show', $manufacturer->id) }}" class="action-btn" style="background-color: #ff9800;">
                                <i class="fas fa-cog"></i>
                                Manage
                            </a>
                            
                            @if($manufacturer->trashed())
                                <form action="{{ route('admin.manufacturers.restore', $manufacturer->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn" style="background-color: #28a745;">
                                        <i class="fas fa-undo"></i>
                                        Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.manufacturers.force-delete', $manufacturer->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" style="background-color: #e53935;" 
                                            onclick="return confirm('Permanently delete this manufacturer? This cannot be undone!')">
                                        <i class="fas fa-trash-alt"></i>
                                        Delete
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}" class="action-btn" style="background-color: #4361ee;">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn" style="background-color: #e53935;" 
                                            onclick="return confirm('Are you sure you want to delete this manufacturer?')">
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
                            No manufacturers found.
                            <br>
                            <a href="{{ route('admin.manufacturers.create') }}" style="color: #4361ee; text-decoration: none; margin-top: 10px; display: inline-block;">
                                <i class="fas fa-plus"></i> Add your first manufacturer
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
            Showing {{ $manufacturers->count() }} of {{ $manufacturers->count() }} entries
        </div>
    </div>
</div>

<!-- Manufacturer Statistics -->
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Manufacturer Statistics</h3>
    </div>
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Total Manufacturers</h3>
                <div class="stat-icon">
                    <i class="fas fa-industry"></i>
                </div>
            </div>
            <div class="stat-value">{{ $totalManufacturers }}</div>
            <div class="stat-change">+{{ $pendingManufacturers }} pending</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Active Manufacturers</h3>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $activeManufacturers }}</div>
            <div class="stat-change">Active</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Inactive Manufacturers</h3>
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="stat-value">{{ $inactiveManufacturers }}</div>
            <div class="stat-change negative">Inactive</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Pending Approvals</h3>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">{{ $pendingManufacturers }}</div>
            <div class="stat-change">Pending</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const manufacturerTableBody = document.getElementById('manufacturerTableBody');
        
        if (searchInput && manufacturerTableBody) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = manufacturerTableBody.querySelectorAll('tr');
                let visibleCount = 0;
                
                rows.forEach(row => {
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
                if (!confirm('Are you sure you want to delete this manufacturer?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Force delete confirmation
        document.querySelectorAll('form[action*="force-delete"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Permanently delete this manufacturer? This action cannot be undone!')) {
                    e.preventDefault();
                }
            });
        });
        
        // Add click handlers for view buttons
        document.querySelectorAll('.view-manufacturer-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const manufacturerId = this.getAttribute('data-id');
                // Show manufacturer details - already handled by link
            });
        });
    });
</script>
@endpush
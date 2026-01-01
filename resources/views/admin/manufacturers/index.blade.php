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
            
            <button class="filter-btn">
                <i class="fas fa-filter"></i>
                Filter
            </button>
        </div>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name of Manufacturer</th>
                    <th>Last Updated On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="manufacturerTableBody">
                @for($i = 1; $i <= 8; $i++)
                <tr>
                    <td>{{ $i }}.</td>
                    <td>
                        <div class="manufacturer-name">Abhishek yadav</div>
                        <div class="manufacturer-company">(AP Logistics)</div>
                    </td>
                    <td class="last-updated">17-12-2025 12:37 PM</td>
                    <td>
                        <button class="action-btn view-manufacturer-btn" data-id="{{ $i }}">
                            <i class="fas fa-eye"></i>
                            View & Manage
                        </button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        <div class="pagination-info">
            Showing 1 to 8 of 8 entries
        </div>
        
        <div class="pagination-controls">
            <button class="pagination-btn" disabled>
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">3</button>
            <button class="pagination-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
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
            <div class="stat-value">08</div>
            <div class="stat-change">+2 this month</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Active Manufacturers</h3>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">06</div>
            <div class="stat-change">+1 this week</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Inactive Manufacturers</h3>
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <div class="stat-value">02</div>
            <div class="stat-change negative">-1 this month</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-header">
                <h3 class="stat-title">Pending Approvals</h3>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">03</div>
            <div class="stat-change">+2 this week</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Manufacturers page specific JavaScript
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
        
        // Add click handlers for view buttons
        document.querySelectorAll('.view-manufacturer-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const manufacturerId = this.getAttribute('data-id');
                showDetailsModal('manufacturer', manufacturerId);
            });
        });
    });
</script>
@endpush
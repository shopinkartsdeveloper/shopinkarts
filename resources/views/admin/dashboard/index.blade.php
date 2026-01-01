@extends('admin.layouts.master')

@section('title', 'Dashboard Overview')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'Here\'s what\'s happening with your store today.')

@section('content')
<!-- Dashboard Stats -->
<div class="dashboard-stats">
    <div class="stat-card" id="totalManufacturersCard">
        <div class="stat-header">
            <h3 class="stat-title">Total Manufacturers</h3>
            <div class="stat-icon">
                <i class="fas fa-industry"></i>
            </div>
        </div>
        <div class="stat-value">12</div>
        <div class="stat-change">+2 this month</div>
    </div>
    
    <div class="stat-card" id="totalSellersCard">
        <div class="stat-header">
            <h3 class="stat-title">Total Sellers</h3>
            <div class="stat-icon">
                <i class="fas fa-store"></i>
            </div>
        </div>
        <div class="stat-value">25</div>
        <div class="stat-change">+5 this month</div>
    </div>
    
    <div class="stat-card" id="totalCategoriesCard">
        <div class="stat-header">
            <h3 class="stat-title">Total Categories</h3>
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
        <div class="stat-value">15</div>
        <div class="stat-change">+3 this month</div>
    </div>
    
    <div class="stat-card" id="newOrdersCard">
        <div class="stat-header">
            <h3 class="stat-title">New Orders</h3>
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
        <div class="stat-value">02</div>
        <div class="stat-change negative">-1 from yesterday</div>
    </div>
    
    <div class="stat-card" id="totalOrdersCard">
        <div class="stat-header">
            <h3 class="stat-title">Total Orders</h3>
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
        <div class="stat-value">08</div>
        <div class="stat-change">+2 this week</div>
    </div>
</div>

<!-- Dashboard Sections -->
<div class="dashboard-sections">
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">Manage Sellers</h3>
            <div class="section-action" id="viewAllSellers">View All</div>
        </div>
        <ul class="section-list">
            <li>
                <span class="list-title">Total Users (Staff)</span>
                <span class="list-value">05</span>
            </li>
            <li>
                <span class="list-title">Active Sellers</span>
                <span class="list-value">18</span>
            </li>
            <li>
                <span class="list-title">Pending Approvals</span>
                <span class="list-value">03</span>
            </li>
        </ul>
    </div>
    
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">Manage Manufacturers</h3>
            <div class="section-action" id="viewAllManufacturers">View All</div>
        </div>
        <ul class="section-list">
            <li>
                <span class="list-title">New Orders</span>
                <span class="list-value">120</span>
            </li>
            <li>
                <span class="list-title">Total Products</span>
                <span class="list-value">120</span>
            </li>
            <li>
                <span class="list-title">Low Stock Items</span>
                <span class="list-value">08</span>
            </li>
        </ul>
    </div>
    
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">Quick Actions</h3>
            <div class="section-action" id="quickActions">More</div>
        </div>
        <ul class="section-list">
            <li id="manageOrdersAction">
                <span class="list-title">Manage Orders</span>
                <span class="list-value">02 New</span>
            </li>
            <li id="manageReturnsAction">
                <span class="list-title">Manage Returns</span>
                <span class="list-value">01 Pending</span>
            </li>
            <li id="manageProductsAction">
                <span class="list-title">Manage Products</span>
                <span class="list-value">120 Total</span>
            </li>
        </ul>
    </div>
</div>

<!-- Recent Activities -->
<div class="section-card mt-4">
    <div class="section-header">
        <h3 class="section-title">Recent Activities</h3>
        <div class="section-action">View All</div>
    </div>
    <ul class="section-list">
        <li>
            <span class="list-title">New seller registration</span>
            <span class="list-value">2 hours ago</span>
        </li>
        <li>
            <span class="list-title">Order #12345 shipped</span>
            <span class="list-value">4 hours ago</span>
        </li>
        <li>
            <span class="list-title">Product review added</span>
            <span class="list-value">6 hours ago</span>
        </li>
        <li>
            <span class="list-title">New manufacturer added</span>
            <span class="list-value">1 day ago</span>
        </li>
    </ul>
</div>
@endsection

@push('scripts')
<script>
    // Dashboard specific JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handlers for dashboard specific elements
        document.getElementById('viewAllSellers').addEventListener('click', function() {
            window.location.href = "{{ route('admin.sellers.index') }}";
        });
        
        document.getElementById('viewAllManufacturers').addEventListener('click', function() {
            window.location.href = "{{ route('admin.manufacturers.index') }}";
        });
        
        document.getElementById('manageOrdersAction').addEventListener('click', function() {
            showNotification('Redirecting to Orders Management...');
        });
        
        document.getElementById('manageReturnsAction').addEventListener('click', function() {
            showNotification('Redirecting to Returns Management...');
        });
        
        document.getElementById('manageProductsAction').addEventListener('click', function() {
            showNotification('Redirecting to Products Management...');
        });
    });
</script>
@endpush
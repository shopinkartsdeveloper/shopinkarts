@extends('admin.layouts.master')

@section('title', 'Customer Dashboard')
@section('page_title', 'Customer Dashboard')
@section('page_subtitle', 'Welcome to your customer dashboard')

@section('content')
<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-header">
            <h3 class="stat-title">Total Orders</h3>
            <div class="stat-icon" style="background-color: #4361ee;">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
        <div class="stat-value">08</div>
        <div class="stat-change">+2 this month</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <h3 class="stat-title">Pending Orders</h3>
            <div class="stat-icon" style="background-color: #4cc9f0;">
                <i class="fas fa-clock"></i>
            </div>
        </div>
        <div class="stat-value">02</div>
        <div class="stat-change">+1 today</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <h3 class="stat-title">Total Spent</h3>
            <div class="stat-icon" style="background-color: #4895ef;">
                <i class="fas fa-rupee-sign"></i>
            </div>
        </div>
        <div class="stat-value">₹25,000</div>
        <div class="stat-change">+5% from last month</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-header">
            <h3 class="stat-title">Wishlist Items</h3>
            <div class="stat-icon" style="background-color: #f72585;">
                <i class="fas fa-heart"></i>
            </div>
        </div>
        <div class="stat-value">05</div>
        <div class="stat-change">+2 recently</div>
    </div>
</div>

<div class="dashboard-sections">
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">Quick Actions</h3>
            <div class="section-action">View All</div>
        </div>
        <ul class="section-list">
            <li>
                <a href="#" style="text-decoration: none; color: inherit;">
                    <span class="list-title">Shop Now</span>
                    <span class="list-value"><i class="fas fa-store"></i></span>
                </a>
            </li>
            <li>
                <a href="#" style="text-decoration: none; color: inherit;">
                    <span class="list-title">My Orders</span>
                    <span class="list-value">08</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.profile') }}" style="text-decoration: none; color: inherit;">
                    <span class="list-title">My Profile</span>
                    <span class="list-value"><i class="fas fa-user"></i></span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">Recent Orders</h3>
            <div class="section-action">View All</div>
        </div>
        <ul class="section-list">
            <li>
                <span class="list-title">Order #12348</span>
                <span class="list-value" style="color: #28a745;">Delivered</span>
            </li>
            <li>
                <span class="list-title">Order #12349</span>
                <span class="list-value" style="color: #ffc107;">Shipped</span>
            </li>
            <li>
                <span class="list-title">Order #12350</span>
                <span class="list-value" style="color: #17a2b8;">Processing</span>
            </li>
        </ul>
    </div>
</div>

<div class="section-card mt-4">
    <div class="section-header">
        <h3 class="section-title">Welcome, Customer!</h3>
    </div>
    <p>You are logged in as a Customer. From this dashboard, you can view your orders, track shipments, update your profile, and shop for new products.</p>
</div>
@endsection

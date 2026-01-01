<div class="sidebar">
    <div class="logo">
        <h1>Shopinkarts</h1>
        <p>Admin Dashboard</p>
    </div>
    
    <div class="menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.sellers.index') }}" class="menu-item {{ request()->routeIs('admin.sellers.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Manage Sellers</span>
            <div class="badge">{{ \App\Models\User::whereHas('roles', function($q) { $q->where('name', 'seller'); })->count() }}</div>
        </a>
        
        <a href="{{ route('admin.manufacturers.index') }}" class="menu-item {{ request()->routeIs('admin.manufacturers.*') ? 'active' : '' }}">
            <i class="fas fa-industry"></i>
            <span>Manage Manufacturers</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-shopping-cart"></i>
            <span>Manage Orders</span>
            <div class="badge">02</div>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-user-tie"></i>
            <span>Manage Staff</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-tags"></i>
            <span>Manage Categories</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-box-open"></i>
            <span>Manage Products</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-undo-alt"></i>
            <span>Manage Returns</span>
        </a>
        
        <a href="#" class="menu-item">
            <i class="fas fa-cubes"></i>
            <span>Manage Materials</span>
        </a>
    </div>
</div>
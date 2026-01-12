<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopinkarts - Admin Seller Screen 2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* All your existing CSS styles here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #3769ca;
            --secondary-color: #2a4f9e;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --info-color: #4895ef;
            --border-radius: 10px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            color: var(--dark-color);
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Fixed Sidebar - MANUFACTURER PAGE SIZES */
        .sidebar {
            width: 250px;
            background: #3769ca;
            color: white;
            padding: 25px 0;
            display: flex;
            flex-direction: column;
            box-shadow: var(--box-shadow);
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            padding: 0 20px;
        }

        .logo h1 {
            width: 190px;
            height: 60px;
            margin: 0 auto 10px auto;
            background-image: url('images/2.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            text-indent: -9999px;
            overflow: hidden;
            border: none;
        }

        .logo p {
            font-size: 14px;
            opacity: 0.8;
            margin-top: 5px;
        }

        .menu {
            flex: 1;
            padding: 0 15px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            margin-bottom: 8px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid white;
        }

        .menu-item i {
            font-size: 20px;
            margin-right: 15px;
            width: 24px;
            text-align: center;
        }

        .menu-item span {
            font-size: 16px;
            font-weight: 500;
        }

        .menu-item .badge {
            margin-left: auto;
            background-color: var(--warning-color);
            color: white;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 600;
        }

        .content-wrapper {
            flex: 1;
            margin-left: 250px;
            width: calc(100% - 250px);
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eaeaea;
            background-color: #f5f7fb;
            z-index: 100;
            position: sticky;
            top: 0;
            flex-shrink: 0;
        }

        .page-title h2 {
            font-size: 28px;
            color: var(--dark-color);
        }

        .page-title p {
            color: #666;
            margin-top: 5px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .user-profile:hover {
            transform: translateY(-2px);
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid var(--primary-color);
        }

        .user-info h4 {
            font-size: 16px;
            margin-bottom: 3px;
        }

        .user-info p {
            font-size: 13px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .profile-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            width: 180px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 1000;
            border: 1px solid #eaeaea;
        }

        .profile-menu.show {
            display: flex;
            animation: fadeIn 0.2s ease;
        }

        .profile-menu div {
            padding: 12px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #f5f5f5;
        }

        .profile-menu div:last-child {
            border-bottom: none;
        }

        .profile-menu div:hover {
            background-color: #f2f4ff;
        }

        .profile-menu div i {
            width: 20px;
            text-align: center;
            color: #666;
        }

        .profile-menu .danger {
            color: #e53935;
        }

        .profile-menu .danger i {
            color: #e53935;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-content {
            flex: 1;
            padding: 0 25px 25px 25px;
            overflow-y: auto;
            height: calc(100vh - 100px);
        }

        .seller-container {
            display: flex;
            gap: 25px;
            margin-top: 20px;
        }

        .seller-details-card {
            flex: 1;
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
        }

        .seller-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .seller-name-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .seller-id {
            font-size: 14px;
            color: #666;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .detail-label {
            font-size: 14px;
            color: #888;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 500;
        }

        .detail-value.highlight {
            color: var(--primary-color);
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .action-btn.primary {
            background-color: var(--primary-color);
            color: white;
        }

        .action-btn.secondary {
            background-color: #f8f9fa;
            color: var(--dark-color);
            border: 1px solid #ddd;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btn.primary:hover {
            background-color: var(--secondary-color);
        }

        .action-btn.secondary:hover {
            background-color: #e9ecef;
        }

        .right-column {
            width: 320px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .payment-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
        }

        .payment-header {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f5f5f5;
        }

        .payment-label {
            font-size: 14px;
            color: #666;
        }

        .payment-value {
            font-size: 16px;
            font-weight: 600;
        }

        .payment-value.success {
            color: #28a745;
        }

        .payment-value.warning {
            color: #ffc107;
        }

        .payment-value.info {
            color: var(--primary-color);
        }

        .update-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            font-size: 14px;
        }

        .update-btn:hover {
            background-color: var(--secondary-color);
        }

        .history-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: var(--primary-color);
            cursor: pointer;
            text-decoration: underline;
        }

        .abstracts-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
        }

        .abstracts-header {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .abstracts-content {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .signature {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f5f5f5;
        }

        .signature-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .signature-role {
            font-size: 13px;
            color: #888;
        }

        /* Add some additional styles for action buttons */
        .action-buttons-top {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .btn-edit {
            background-color: #4361ee;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }
        
        .btn-back {
            background-color: #6c757d;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }
        
        .deleted-badge {
            background-color: #e53935;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-left: 10px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Custom Scrollbars */
        .main-content::-webkit-scrollbar {
            width: 8px;
        }

        .main-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        @media (max-width: 1200px) {
            .seller-container {
                flex-direction: column;
            }
            
            .right-column {
                width: 100%;
            }
        }

        @media (max-width: 992px) {
            body {
                flex-direction: column;
                overflow: auto;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 15px 0;
            }
            
            .menu {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                padding: 0 10px;
            }
            
            .menu-item {
                margin: 5px;
                padding: 12px 15px;
            }
            
            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            
            .main-content {
                height: auto;
                overflow: visible;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 0 15px 15px 15px;
            }
            
            .seller-details-card, .payment-card, .abstracts-card {
                padding: 20px;
            }
            
            .details-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                position: relative;
                padding: 15px;
            }
            
            .user-profile {
                margin-top: 15px;
            }
        }

        @media (max-width: 576px) {
            .seller-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .action-buttons, .action-buttons-top {
                flex-direction: column;
            }
            
            .action-btn, .btn-edit, .btn-back {
                width: 100%;
                justify-content: center;
            }
            
            .profile-menu {
                width: 160px;
                right: -10px;
            }
        }
    </style>
</head>
<body>
    <!-- Fixed Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h1>Shopinkarts</h1>
            <p>Admin Seller</p>
        </div>
        
        <div class="menu">
            <div class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item active">
                <i class="fas fa-users"></i>
                <span>Manage Sellers</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-industry"></i>
                <span>Manage Manufa.</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>New Orders</span>
                <div class="badge">02</div>
            </div>
            <div class="menu-item">
                <i class="fas fa-clipboard-list"></i>
                <span>Manage Orders</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-undo-alt"></i>
                <span>Manage Returns</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-user-tie"></i>
                <span>Manage Staff</span>
            </div>
            <div class="menu-item ">
                <i class="fas fa-box-open"></i>
                <span>Manage Products</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-tags"></i>
                <span>Manage Categories</span>
            </div>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Fixed Header -->
        <div class="header">
            <div class="page-title">
                <h2>Admin Seller Screen 2</h2>
                <p>Shopinkarts</p>
            </div>
            
            <!-- User Profile with Dropdown -->
            <div class="user-profile" id="userProfileBtn">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=3769ca&color=fff&bold=true&size=128" alt="Admin User">
                <div class="user-info">
                    <h4>Admin User</h4>
                    <p>Super Admin</p>
                </div>
            </div>
        </div>
        
        <!-- Scrollable Content -->
        <div class="main-content">
            <div class="action-buttons-top">
                <a href="{{ route('admin.sellers.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('admin.sellers.edit', $seller->id) }}" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit Seller
                </a>
                @if($seller->trashed())
                    <form action="{{ route('admin.sellers.restore', $seller->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-edit" style="background-color: #28a745;">
                            <i class="fas fa-undo"></i> Restore Seller
                        </button>
                    </form>
                    <form action="{{ route('admin.sellers.force-delete', $seller->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-edit" style="background-color: #e53935;" 
                                onclick="return confirm('Permanently delete this seller? This cannot be undone!')">
                            <i class="fas fa-trash-alt"></i> Delete Permanently
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.sellers.destroy', $seller->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-edit" style="background-color: #e53935;" 
                                onclick="return confirm('Are you sure you want to delete this seller?')">
                            <i class="fas fa-trash"></i> Delete Seller
                        </button>
                    </form>
                @endif
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
            
            @if($seller->trashed())
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #e53935;">
                    This seller has been deleted on {{ $seller->deleted_at->format('d-m-Y H:i A') }}
                </div>
            @endif
            
            <div class="seller-container">
                <!-- Left Column - Seller Details -->
                <div class="seller-details-card">
                    <div class="seller-header">
                        <div class="seller-name-title">Seller Details 
                            @if($seller->trashed())
                                <span class="deleted-badge">Deleted</span>
                            @else
                                @if($seller->status == 'active')
                                    <span class="status-badge status-active">Active</span>
                                @elseif($seller->status == 'inactive')
                                    <span class="status-badge status-inactive">Inactive</span>
                                @else
                                    <span class="status-badge status-pending">Pending</span>
                                @endif
                            @endif
                        </div>
                        <div class="seller-id">ID: {{ strtoupper(substr($seller->firm_name, 0, 2)) }}{{ $seller->id }}</div>
                    </div>
                    
                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="detail-label">First Name</div>
                            <div class="detail-value highlight">{{ $seller->first_name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Last Name</div>
                            <div class="detail-value highlight">{{ $seller->last_name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Mobile Number</div>
                            <div class="detail-value">{{ $seller->mobile_number }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email ID</div>
                            <div class="detail-value highlight">{{ $seller->email }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Whatsapp Number</div>
                            <div class="detail-value">{{ $seller->whatsapp_number ?? '-' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Firm Name</div>
                            <div class="detail-value highlight">{{ $seller->firm_name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">GST Number</div>
                            <div class="detail-value">{{ $seller->gst_number ?? '-' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Shop Name (Meesho)</div>
                            <div class="detail-value highlight">{{ $seller->shop_name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Company Name</div>
                            <div class="detail-value">{{ $seller->company_name ?? $seller->firm_name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">User Role</div>
                            <div class="detail-value highlight">
                                @foreach($seller->roles as $role)
                                    {{ ucfirst($role->name) }}
                                @endforeach
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Created At</div>
                            <div class="detail-value">{{ $seller->created_at->format('d-m-Y H:i A') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Last Updated</div>
                            <div class="detail-value">{{ $seller->updated_at->format('d-m-Y H:i A') }}</div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="action-btn primary">
                            <i class="fas fa-eye"></i>
                            View Order History
                        </button>
                        <button class="action-btn primary">
                            <i class="fas fa-boxes"></i>
                            View All Inventory
                        </button>
                        <button class="action-btn secondary">
                            <i class="fas fa-undo-alt"></i>
                            View All Returns
                        </button>
                        <button class="action-btn secondary">
                            <i class="fas fa-history"></i>
                            View Manifesto History
                        </button>
                        <button class="action-btn primary" style="grid-column: span 2;">
                            <i class="fas fa-shipping-fast"></i>
                            Today Dispatched order
                        </button>
                    </div>
                </div>
                
                <!-- Right Column - Payment Info & Abstracts -->
                <div class="right-column">
                    <!-- Payment Card -->
                    <div class="payment-card">
                        <div class="payment-header">Payment On Meesho</div>
                        
                        <div class="payment-item">
                            <div class="payment-label">Payment On Meesho</div>
                            <div class="payment-value success">13,000</div>
                        </div>
                        
                        <div class="payment-item">
                            <div class="payment-label">Return On Meesho</div>
                            <div class="payment-value warning">1,700</div>
                        </div>
                        
                        <div class="payment-item">
                            <div class="payment-label">Cash in Hand</div>
                            <div class="payment-value info">2,300</div>
                        </div>
                        
                        <button class="update-btn">
                            <i class="fas fa-sync-alt"></i> Update Now
                        </button>
                        
                        <div class="history-link">View History</div>
                    </div>
                    
                    <!-- Abstracts Card -->
                    <div class="abstracts-card">
                        <div class="abstracts-header">Abstracts</div>
                        
                        <div class="abstracts-content">
                            <p>This seller has been verified and approved for all e-commerce activities. All documents are verified and found to be genuine.</p>
                            
                            <div class="signature">
                                <div class="signature-name">Abhishek Yadav</div>
                                <div class="signature-role">Sup. Admin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional content for scrolling -->
            <div style="margin-top: 30px; background: white; padding: 25px; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
                <div style="font-size: 22px; font-weight: 600; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee;">Recent Activities</div>
                <div style="margin-top: 15px;">
                    <div style="display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f5f5f5;">
                        <div style="width: 40px; height: 40px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="fas fa-user-plus" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">Seller created</div>
                            <div style="font-size: 14px; color: #666;">Seller profile was created</div>
                        </div>
                        <div style="font-size: 14px; color: #666;">{{ $seller->created_at->format('d-m-Y H:i A') }}</div>
                    </div>
                    <div style="display: flex; align-items: center; padding: 12px 0; border-bottom: 1px solid #f5f5f5;">
                        <div style="width: 40px; height: 40px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="fas fa-edit" style="color: #6f42c1;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 500;">Profile updated</div>
                            <div style="font-size: 14px; color: #666;">Last updated on {{ $seller->updated_at->format('d-m-Y') }}</div>
                        </div>
                        <div style="font-size: 14px; color: #666;">{{ $seller->updated_at->format('H:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
</body>
</html>
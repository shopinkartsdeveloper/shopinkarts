<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopinkarts - Admin Manufacturer Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --info-color: #4895ef;
            --border-radius: 12px;
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

        /* Fixed Sidebar */
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

        /* Content Wrapper */
        .content-wrapper {
            flex: 1;
            margin-left: 250px;
            width: calc(100% - 250px);
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* Fixed Header */
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

        /* Scrollable Content */
        .main-content {
            flex: 1;
            padding: 0 25px 25px 25px;
            overflow-y: auto;
            height: calc(100vh - 100px);
        }

        /* Action Buttons Top */
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

        /* Manufacturer Details Section */
        .manufacturer-details-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-top: 20px;
        }

        .section-title-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Manufacturer Profile Header */
        .manufacturer-profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .manufacturer-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            border: 5px solid white;
            box-shadow: var(--box-shadow);
        }

        .manufacturer-avatar i {
            font-size: 48px;
            color: white;
        }

        .manufacturer-info h2 {
            font-size: 28px;
            margin-bottom: 5px;
            color: var(--dark-color);
        }

        .manufacturer-info p {
            font-size: 16px;
            color: var(--primary-color);
            font-weight: 600;
            background-color: #f0f4ff;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
        }

        /* Details Grid */
        .details-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--dark-color);
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .detail-item {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .detail-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .detail-value.highlight {
            color: var(--primary-color);
        }

        /* Edit Button */
        .edit-btn-container {
            text-align: center;
            margin-top: 40px;
        }

        .edit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 40px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .edit-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
        }

        /* Payment Statistics Section */
        .payment-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-top: 30px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .payment-card {
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }

        .payment-card.paid {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border-left: 4px solid #28a745;
        }

        .payment-card.pending {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            border-left: 4px solid #ff9800;
        }

        .payment-label {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .payment-amount {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .payment-amount.paid {
            color: #28a745;
        }

        .payment-amount.pending {
            color: #ff9800;
        }

        .payment-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .payment-btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .payment-btn.update {
            background-color: var(--primary-color);
            color: white;
        }

        .payment-btn.history {
            background-color: #6c757d;
            color: white;
        }

        .payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Order History Section */
        .order-history-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .order-history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .history-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .history-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .orders-list {
            margin-top: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: var(--transition);
        }

        .order-item:hover {
            background-color: #f9f9f9;
        }

        .order-icon {
            width: 40px;
            height: 40px;
            background: #e3f2fd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
        }

        .order-info {
            flex: 1;
        }

        .order-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .order-desc {
            font-size: 14px;
            color: #666;
        }

        .order-time {
            font-size: 14px;
            color: #999;
            white-space: nowrap;
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

        /* Responsive Styles */
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
            
            .manufacturer-profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .manufacturer-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .details-grid {
                grid-template-columns: 1fr;
            }
            
            .payment-grid {
                grid-template-columns: 1fr;
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
            
            .order-history-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .action-buttons-top {
                flex-direction: column;
            }
            
            .btn-edit, .btn-back {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .manufacturer-details-section, 
            .payment-section, 
            .order-history-section {
                padding: 15px;
            }
            
            .manufacturer-avatar {
                width: 80px;
                height: 80px;
            }
            
            .manufacturer-info h2 {
                font-size: 24px;
            }
            
            .detail-value {
                font-size: 16px;
            }
            
            .payment-amount {
                font-size: 24px;
            }
            
            .payment-actions {
                flex-direction: column;
            }
            
            .edit-btn {
                padding: 12px 30px;
                font-size: 14px;
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
            <h1></h1>
            <p>Shopinkarts</p>
        </div>
        
        <div class="menu">
            <div class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item">
                <i class="fas fa-users"></i>
                <span>Manage Sellers</span>
            </div>
            <div class="menu-item active">
                <i class="fas fa-industry"></i>
                <span>Manage Manufa...</span>
                <div class="badge">08</div>
            </div>
            <div class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>New Orders</span>
                <div class="badge">02</div>
            </div>
            <div class="menu-item">
                <i class="fas fa-shopping-bag"></i>
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
            <div class="menu-item">
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
                <h2>Admin Manufacturer Screen 2</h2>
                <p>Manufacturer Details</p>
            </div>
            
            <div class="user-profile" id="userProfileBtn">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=4361ee&color=fff&bold=true&size=128" alt="Admin User">
                <div class="user-info">
                    <h4>Admin User</h4>
                    <p>Super Admin</p>
                </div>
            </div>
        </div>
        
        <!-- Scrollable Content -->
        <div class="main-content">
            <div class="action-buttons-top">
                <a href="{{ route('admin.manufacturers.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit Manufacturer
                </a>
                @if($manufacturer->trashed())
                    <form action="{{ route('admin.manufacturers.restore', $manufacturer->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-edit" style="background-color: #28a745;">
                            <i class="fas fa-undo"></i> Restore Manufacturer
                        </button>
                    </form>
                    <form action="{{ route('admin.manufacturers.force-delete', $manufacturer->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-edit" style="background-color: #e53935;" 
                                onclick="return confirm('Permanently delete this manufacturer? This cannot be undone!')">
                            <i class="fas fa-trash-alt"></i> Delete Permanently
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.manufacturers.destroy', $manufacturer->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-edit" style="background-color: #e53935;" 
                                onclick="return confirm('Are you sure you want to delete this manufacturer?')">
                            <i class="fas fa-trash"></i> Delete Manufacturer
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
            
            @if($manufacturer->trashed())
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #e53935;">
                    This manufacturer has been deleted on {{ $manufacturer->deleted_at->format('d-m-Y H:i A') }}
                </div>
            @endif
            
            <!-- Manufacturer Details Section -->
            <div class="manufacturer-details-section">
                <!-- Manufacturer Profile Header -->
                <div class="manufacturer-profile-header">
                    <div class="manufacturer-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="manufacturer-info">
                        <h2>{{ $manufacturer->first_name }} {{ $manufacturer->last_name }}</h2>
                        <p>{{ $manufacturer->firm_name }}</p>
                        @if($manufacturer->trashed())
                            <span class="deleted-badge">Deleted</span>
                        @else
                            @if($manufacturer->status == 'active')
                                <span class="status-badge status-active">Active</span>
                            @elseif($manufacturer->status == 'inactive')
                                <span class="status-badge status-inactive">Inactive</span>
                            @else
                                <span class="status-badge status-pending">Pending</span>
                            @endif
                        @endif
                    </div>
                </div>
                
                <!-- Manufacturer Details -->
                <h3 class="details-title">Manufacturer Details</h3>
                
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">First Name</div>
                        <div class="detail-value highlight">{{ $manufacturer->first_name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Last Name</div>
                        <div class="detail-value highlight">{{ $manufacturer->last_name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Mobile Number</div>
                        <div class="detail-value">{{ $manufacturer->mobile_number }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Email ID</div>
                        <div class="detail-value highlight">{{ $manufacturer->email }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Whatsapp Number</div>
                        <div class="detail-value">{{ $manufacturer->whatsapp_number ?? '-' }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Firm Name</div>
                        <div class="detail-value highlight">{{ $manufacturer->firm_name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">GST Number</div>
                        <div class="detail-value">{{ $manufacturer->gst_number ?? '-' }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Shop Name (Meesho)</div>
                        <div class="detail-value highlight">{{ $manufacturer->shop_name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Company Name</div>
                        <div class="detail-value">{{ $manufacturer->company_name ?? $manufacturer->firm_name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">User Role</div>
                        <div class="detail-value highlight">
                            @foreach($manufacturer->roles as $role)
                                {{ ucfirst($role->name) }}
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Created At</div>
                        <div class="detail-value">{{ $manufacturer->created_at->format('d-m-Y H:i A') }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Last Updated</div>
                        <div class="detail-value">{{ $manufacturer->updated_at->format('d-m-Y H:i A') }}</div>
                    </div>
                </div>
                
                <!-- Edit Button -->
                <div class="edit-btn-container">
                    <a href="{{ route('admin.manufacturers.edit', $manufacturer->id) }}" class="edit-btn" id="editDetailsBtn">
                        <i class="fas fa-edit"></i>
                        Edit Details
                    </a>
                </div>
            </div>
            
            <!-- Payment Statistics Section -->
            <div class="payment-section">
                <div class="section-title-bar">
                    <h3 class="section-title">Payment Overview</h3>
                </div>
                
                <div class="payment-grid">
                    <div class="payment-card paid">
                        <div class="payment-label">Payment Done</div>
                        <div class="payment-amount paid">₹23,000</div>
                        <div class="payment-actions">
                            <button class="payment-btn history">
                                <i class="fas fa-history"></i>
                                View History
                            </button>
                        </div>
                    </div>
                    
                    <div class="payment-card pending">
                        <div class="payment-label">Payment Pending</div>
                        <div class="payment-amount pending">₹10,700</div>
                        <div class="payment-actions">
                            <button class="payment-btn update">
                                <i class="fas fa-sync-alt"></i>
                                Update Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order History Section -->
            <div class="order-history-section">
                <div class="order-history-header">
                    <h3 class="section-title">Today Dispatched Orders</h3>
                    <button class="history-btn" id="viewOrderHistoryBtn">
                        <i class="fas fa-list"></i>
                        View Order History
                    </button>
                </div>
                
                <div class="orders-list">
                    <div class="order-item">
                        <div class="order-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="order-info">
                            <div class="order-title">Order #ORD-12345</div>
                            <div class="order-desc">2 items • Delivery to Mumbai</div>
                        </div>
                        <div class="order-time">09:30 AM</div>
                    </div>
                    
                    <div class="order-item">
                        <div class="order-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="order-info">
                            <div class="order-title">Order #ORD-12346</div>
                            <div class="order-desc">1 item • Delivery to Delhi</div>
                        </div>
                        <div class="order-time">10:15 AM</div>
                    </div>
                    
                    <div class="order-item">
                        <div class="order-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="order-info">
                            <div class="order-title">Order #ORD-12347</div>
                            <div class="order-desc">3 items • Delivery to Bangalore</div>
                        </div>
                        <div class="order-time">11:45 AM</div>
                    </div>
                    
                    <div class="order-item">
                        <div class="order-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="order-info">
                            <div class="order-title">Order #ORD-12348</div>
                            <div class="order-desc">5 items • Delivery to Kolkata</div>
                        </div>
                        <div class="order-time">01:20 PM</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Manufacturer Modal -->
    <div class="modal" id="editManufacturerModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Manufacturer Details</h3>
                <div class="close-modal" id="closeEditModal">&times;</div>
            </div>
            <div class="modal-body">
                <div id="editManufacturerContent">
                    <!-- Edit form would go here in a real application -->
                    <p style="text-align: center; padding: 40px 20px; color: #666;">
                        In a real application, this would contain a form to edit manufacturer details.
                        <br><br>
                        <i class="fas fa-edit" style="font-size: 48px; color: #ddd; margin-bottom: 20px; display: block;"></i>
                        Edit form would appear here
                    </p>
                </div>
                
                <div class="modal-actions">
                    <button class="modal-btn secondary" id="cancelEditBtn">Cancel</button>
                    <button class="modal-btn primary" id="saveManufacturerBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const menuItems = document.querySelectorAll('.menu-item');
        const userProfileBtn = document.getElementById('userProfileBtn');
        const profileMenu = document.getElementById('profileMenu');
        const editDetailsBtn = document.getElementById('editDetailsBtn');
        const viewOrderHistoryBtn = document.getElementById('viewOrderHistoryBtn');
        const updateNowBtn = document.querySelector('.payment-btn.update');
        const viewHistoryBtn = document.querySelector('.payment-btn.history');
        
        // Modal Elements
        const editManufacturerModal = document.getElementById('editManufacturerModal');
        const closeEditModal = document.getElementById('closeEditModal');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const saveManufacturerBtn = document.getElementById('saveManufacturerBtn');

        // Menu item click handler
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all menu items
                menuItems.forEach(menuItem => {
                    menuItem.classList.remove('active');
                });
                
                // Add active class to clicked menu item
                this.classList.add('active');
                
                // Update page title based on menu item
                const menuText = this.querySelector('span').textContent;
                document.querySelector('.page-title h2').textContent = menuText;
                document.querySelector('.page-title p').textContent = `Manage ${menuText} data and settings`;
            });
        });

        // Delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this manufacturer?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Force delete confirmation
            const forceDeleteForms = document.querySelectorAll('form[action*="force-delete"]');
            forceDeleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Permanently delete this manufacturer? This action cannot be undone!')) {
                        e.preventDefault();
                    }
                });
            });
        });

        // View order history button handler
        if (viewOrderHistoryBtn) {
            viewOrderHistoryBtn.addEventListener('click', function() {
                alert("Order history page would open here.");
            });
        }

        // Update payment button handler
        if (updateNowBtn) {
            updateNowBtn.addEventListener('click', function() {
                alert("Payment update functionality would open here.");
            });
        }

        // View payment history button handler
        if (viewHistoryBtn) {
            viewHistoryBtn.addEventListener('click', function() {
                alert("Payment history would open here.");
            });
        }

        // Add CSS for modal styles
        const style = document.createElement('style');
        style.textContent = `
            /* Modal Styles */
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 2000;
                align-items: center;
                justify-content: center;
            }

            .modal-content {
                background-color: white;
                width: 90%;
                max-width: 600px;
                border-radius: var(--border-radius);
                padding: 30px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                position: relative;
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }

            .modal-title {
                font-size: 22px;
                font-weight: 600;
                color: var(--dark-color);
            }

            .close-modal {
                font-size: 28px;
                cursor: pointer;
                color: #999;
                transition: var(--transition);
            }

            .close-modal:hover {
                color: var(--dark-color);
            }

            .modal-body {
                margin-bottom: 25px;
            }

            .modal-actions {
                display: flex;
                gap: 15px;
                margin-top: 25px;
            }

            .modal-btn {
                flex: 1;
                padding: 12px;
                border-radius: 8px;
                border: none;
                font-weight: 500;
                cursor: pointer;
                transition: var(--transition);
            }

            .modal-btn.primary {
                background-color: var(--primary-color);
                color: white;
            }

            .modal-btn.secondary {
                background-color: #f8f9fa;
                color: var(--dark-color);
                border: 1px solid #ddd;
            }

            .modal-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
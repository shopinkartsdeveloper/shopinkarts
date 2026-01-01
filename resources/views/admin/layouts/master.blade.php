<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Shopinkarts - Admin Panel')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin Dashboard CSS -->
    <link href="{{ asset('admin/css/dashboard.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Fixed Sidebar -->
    @include('admin.layouts.components.sidebar')
    
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Fixed Header -->
        @include('admin.layouts.components.header')
        
        <!-- Scrollable Content -->
        <div class="main-content">
            @yield('content')
        </div>
        
        <!-- Fixed Footer -->
        @include('admin.layouts.components.footer')
    </div>
    
    <!-- Admin Dashboard JS -->
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
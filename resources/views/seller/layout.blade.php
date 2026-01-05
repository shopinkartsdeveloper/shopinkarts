<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopInKarts - Seller Dashboard')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('seller/css/dashboard.css') }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @stack('styles')
</head>
<body>
    <!-- Mobile Frame -->
    <div class="mobile">
        <!-- Header -->
        @include('seller.dashboard.partials.header')
        
        <!-- Main Content -->
        <main class="content">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('seller.dashboard.partials.footer')
    </div>
    
    <!-- JavaScript -->
    <script src="{{ asset('seller/js/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
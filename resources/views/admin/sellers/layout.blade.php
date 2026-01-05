<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopInKarts - Seller Dashboard')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/seller/dashboard.css') }}">
    
    <!-- Yield for page-specific CSS -->
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
    <script src="{{ asset('js/seller/dashboard.js') }}"></script>
    
    <!-- Yield for page-specific JS -->
    @stack('scripts')
</body>
</html>
<!-- HEADER -->
<div class="top">
    <div class="logo">
        <img src="{{ asset('images/1.jpg') }}" alt="ShopInKarts">
    </div>
    <h3>HELLO, {{ strtoupper(auth()->user()->name) }}</h3>
    <div class="menu-btn" onclick="toggleMenu()">☰</div>
</div>

<!-- DROPDOWN MENU -->
<div class="menu">
    <div onclick="showAlert('Profile')">Profile</div>
    <div onclick="showAlert('Settings')">Settings</div>
    <div onclick="showAlert('Help')">Help</div>
    <div class="danger" onclick="logout()">Logout</div>
</div>
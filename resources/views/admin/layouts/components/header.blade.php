<div class="header">
    <div class="page-title">
        <h2>@yield('page_title', 'Dashboard Overview')</h2>
        <p>
            Welcome back, {{ auth()->user()->name ?? 'Admin' }}.
            @yield('page_subtitle', 'Here\'s what\'s happening with your store today.')
        </p>
    </div>
    
    <div class="user-profile" id="userProfileBtn">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=4361ee&color=fff&bold=true&size=128" 
             alt="{{ auth()->user()->name ?? 'Admin' }}">
        <div class="user-info">
            <h4>{{ auth()->user()->name ?? 'Admin' }}</h4>
            <p>Sup. Admin</p>
        </div>
        
        <div class="profile-menu" id="profileMenu">
            <div onclick="handleProfileAction('profile')">
                <i class="fas fa-user-circle"></i>
                <span>Profile</span>
            </div>
            <div onclick="handleProfileAction('settings')">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
            <div onclick="handleProfileAction('help')">
                <i class="fas fa-question-circle"></i>
                <span>Help</span>
            </div>
            <div class="danger" onclick="handleProfileAction('logout')">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </div>
        </div>
    </div>
</div>

<!-- Logout Form (Hidden) -->
<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>
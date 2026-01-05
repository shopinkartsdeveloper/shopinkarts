// Menu toggle function
function toggleMenu() {
    const menu = document.querySelector('.menu');
    menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
}

// Show alert function
function showAlert(action) {
    alert(`Action: ${action}\nThis would navigate to the ${action} page in a real application.`);
    
    // Close menu after selection
    const menu = document.querySelector('.menu');
    menu.style.display = 'none';
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        // Create a form for logout
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/logout';
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_token';
            input.value = csrfToken.getAttribute('content');
            form.appendChild(input);
        }
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Navigate function
function navigateTo(page) {
    switch(page) {
        case 'view-returns':
            window.location.href = '/manufacturer/returns';
            break;
        case 'view-orders':
            window.location.href = '/manufacturer/orders';
            break;
        default:
            showAlert(page);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const menu = document.querySelector('.menu');
        const btn = document.querySelector('.menu-btn');
        
        if (menu && btn && !menu.contains(e.target) && !btn.contains(e.target)) {
            menu.style.display = 'none';
        }
    });
    
    // Make footer buttons interactive
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            navItems.forEach(navItem => navItem.classList.remove('active'));
            // Add active class to clicked item
            this.classList.add('active');
            
            const page = this.getAttribute('data-page');
            navigateToPage(page);
        });
    });
    
    // Make cards clickable
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('click', function() {
            const title = this.querySelector('p').textContent;
            const value = this.querySelector('h3').textContent;
            const type = this.getAttribute('data-type');
            
            alert(`Selected: ${title}\nValue: ₹${value}`);
            
            // You can add specific actions based on card type
            switch(type) {
                case 'total-sales':
                    // Handle total sales click
                    break;
                case 'payment-received':
                    // Handle payment received click
                    break;
                case 'payment-pending':
                    // Handle payment pending click
                    break;
            }
        });
    });
    
    // Action buttons
    const bigBtn = document.querySelector('.big-btn');
    if (bigBtn) {
        bigBtn.addEventListener('click', function() {
            showAlert('New Orders');
        });
    }
    
    // Two buttons
    const twoButtons = document.querySelectorAll('.two-btn button');
    twoButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            navigateTo(action.toLowerCase().replace(' ', '-'));
        });
    });
});

// Navigation function for footer
function navigateToPage(page) {
    switch(page) {
        case 'home':
            window.location.href = '/manufacturer/dashboard';
            break;
        case 'orders':
            window.location.href = '/manufacturer/orders';
            break;
        case 'return':
            window.location.href = '/manufacturer/returns';
            break;
        case 'profile':
            window.location.href = '/manufacturer/profile';
            break;
        default:
            console.log(`Navigate to: ${page}`);
    }
}
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
        // Send logout request
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/login';
            }
        })
        .catch(error => {
            console.error('Logout error:', error);
            window.location.href = '/login';
        });
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
            const value = this.querySelector('h2').textContent;
            const type = this.getAttribute('data-type');
            
            alert(`Selected: ${title}\nValue: ${value}`);
            
            // You can add specific actions based on card type
            switch(type) {
                case 'total-purchase':
                    // Handle total purchase click
                    break;
                case 'total-profit':
                    // Handle total profit click
                    break;
                // Add more cases as needed
            }
        });
    });
    
    // Action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            showAlert(action);
        });
    });
});

// Navigation function
function navigateToPage(page) {
    switch(page) {
        case 'home':
            // Already on home page
            break;
        case 'orders':
            window.location.href = '/seller/orders';
            break;
        case 'return':
            window.location.href = '/seller/returns';
            break;
        case 'inventory':
            window.location.href = '/seller/inventory';
            break;
        case 'profile':
            window.location.href = '/seller/profile';
            break;
        default:
            console.log(`Navigate to: ${page}`);
    }
}
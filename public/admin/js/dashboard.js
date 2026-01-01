/**
 * Shopinkarts Admin Dashboard JavaScript
 * Version: 1.0.0
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeDashboard();
});

// Main initialization function
function initializeDashboard() {
    // DOM Elements
    const userProfileBtn = document.getElementById('userProfileBtn');
    const profileMenu = document.getElementById('profileMenu');
    const menuItems = document.querySelectorAll('.menu-item');
    const statCards = document.querySelectorAll('.stat-card');
    const sectionActions = document.querySelectorAll('.section-action');
    const actionButtons = document.querySelectorAll('.action-btn');
    const paginationButtons = document.querySelectorAll('.pagination-btn');
    const searchInputs = document.querySelectorAll('.search-box input');
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    // Initialize components
    initProfileDropdown();
    initMenuNavigation();
    initStatCards();
    initSectionActions();
    initActionButtons();
    initPagination();
    initSearchFunctionality();
    initFilterButtons();
    initModals();
    initRealTimeUpdates();
}

// ====================
// PROFILE DROPDOWN
// ====================
function initProfileDropdown() {
    const userProfileBtn = document.getElementById('userProfileBtn');
    const profileMenu = document.getElementById('profileMenu');
    
    if (!userProfileBtn || !profileMenu) return;
    
    // Toggle dropdown
    userProfileBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        profileMenu.classList.toggle('show');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!userProfileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.remove('show');
        }
    });
    
    // Handle profile actions
    window.handleProfileAction = function(action) {
        profileMenu.classList.remove('show');
        
        switch(action) {
            case 'profile':
                alert("Profile page would open here.");
                break;
            case 'settings':
                alert("Settings page would open here.");
                break;
            case 'help':
                alert("Help & Support page would open here.");
                break;
            case 'logout':
                if(confirm("Are you sure you want to logout?")) {
                    document.getElementById('logoutForm').submit();
                }
                break;
        }
    };
}

// ====================
// MENU NAVIGATION
// ====================
function initMenuNavigation() {
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all menu items
            menuItems.forEach(menuItem => {
                menuItem.classList.remove('active');
            });
            
            // Add active class to clicked menu item
            this.classList.add('active');
            
            // If it's not a link (has no href), prevent default
            if (!this.getAttribute('href') || this.getAttribute('href') === '#') {
                const menuText = this.querySelector('span').textContent;
                showNotification(`Navigating to ${menuText}...`);
            }
        });
    });
}

// ====================
// STAT CARDS
// ====================
function initStatCards() {
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach(card => {
        card.addEventListener('click', function() {
            const title = this.querySelector('.stat-title').textContent;
            const value = this.querySelector('.stat-value').textContent;
            
            // Show modal with stats
            showStatsModal(title, value);
            
            // Add click animation
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}

// ====================
// SECTION ACTIONS
// ====================
function initSectionActions() {
    const sectionActions = document.querySelectorAll('.section-action');
    
    sectionActions.forEach(action => {
        action.addEventListener('click', function() {
            const sectionTitle = this.closest('.section-header').querySelector('.section-title').textContent;
            showNotification(`Viewing all items for ${sectionTitle}`);
        });
    });
}

// ====================
// ACTION BUTTONS
// ====================
function initActionButtons() {
    const actionButtons = document.querySelectorAll('.action-btn');
    
    actionButtons.forEach(btn => {
        if (btn.classList.contains('view-seller-btn') || btn.classList.contains('view-manufacturer-btn')) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const type = this.classList.contains('view-seller-btn') ? 'seller' : 'manufacturer';
                showDetailsModal(type, id);
            });
        }
        
        // Add click effect
        btn.addEventListener('click', function() {
            addRippleEffect(this);
        });
    });
}

// ====================
// PAGINATION
// ====================
function initPagination() {
    const paginationButtons = document.querySelectorAll('.pagination-btn');
    
    paginationButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.disabled) return;
            
            // Remove active class from all pagination buttons
            paginationButtons.forEach(b => {
                b.classList.remove('active');
            });
            
            // Add active class to clicked button if it's a number button
            if (!this.querySelector('i')) {
                this.classList.add('active');
            }
            
            const pageNum = this.textContent;
            showNotification(`Loading page ${pageNum}...`);
        });
    });
}

// ====================
// SEARCH FUNCTIONALITY
// ====================
function initSearchFunctionality() {
    const searchInputs = document.querySelectorAll('.search-box input');
    
    searchInputs.forEach(input => {
        input.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableId = this.closest('.data-table-section')?.querySelector('tbody')?.id;
            
            if (!tableId) return;
            
            const tableBody = document.getElementById(tableId);
            if (!tableBody) return;
            
            const rows = tableBody.querySelectorAll('tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Update pagination info
            const paginationInfo = this.closest('.data-table-section')?.querySelector('.pagination-info');
            if (paginationInfo) {
                paginationInfo.textContent = `Showing 1 to ${visibleCount} of ${visibleCount} entries`;
            }
        });
    });
}

// ====================
// FILTER BUTTONS
// ====================
function initFilterButtons() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            showNotification('Filter options would open here');
        });
    });
}

// ====================
// MODALS
// ====================
function initModals() {
    // Create modal container if it doesn't exist
    if (!document.getElementById('modalContainer')) {
        const modalContainer = document.createElement('div');
        modalContainer.id = 'modalContainer';
        modalContainer.className = 'modal';
        modalContainer.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalTitle">Details</h3>
                    <div class="close-modal" id="closeModal">&times;</div>
                </div>
                <div class="modal-body">
                    <p id="modalDescription"></p>
                    <div class="modal-stats" id="modalStats"></div>
                    <div class="modal-actions">
                        <button class="modal-btn secondary" id="closeModalBtn">Close</button>
                        <button class="modal-btn primary" id="actionModalBtn">Action</button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modalContainer);
        
        // Add event listeners
        document.getElementById('closeModal').addEventListener('click', closeModal);
        document.getElementById('closeModalBtn').addEventListener('click', closeModal);
        
        // Close modal when clicking outside
        modalContainer.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    }
}

function showStatsModal(title, value) {
    const modal = document.getElementById('modalContainer');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalStats = document.getElementById('modalStats');
    const actionBtn = document.getElementById('actionModalBtn');
    
    modalTitle.textContent = title;
    modalDescription.textContent = `Detailed statistics for ${title}`;
    
    // Generate stats based on title
    let statsHTML = `
        <div class="modal-stat">
            <div class="modal-stat-value">${value}</div>
            <div class="modal-stat-label">Current Value</div>
        </div>
    `;
    
    if (title.includes('Manufacturers')) {
        statsHTML += `
            <div class="modal-stat">
                <div class="modal-stat-value">08</div>
                <div class="modal-stat-label">Active</div>
            </div>
            <div class="modal-stat">
                <div class="modal-stat-value">04</div>
                <div class="modal-stat-label">Inactive</div>
            </div>
        `;
        actionBtn.textContent = 'View All Manufacturers';
        actionBtn.onclick = function() { window.location.href = "{{ route('admin.manufacturers.index') }}"; };
    } else if (title.includes('Sellers')) {
        statsHTML += `
            <div class="modal-stat">
                <div class="modal-stat-value">18</div>
                <div class="modal-stat-label">Active</div>
            </div>
            <div class="modal-stat">
                <div class="modal-stat-value">07</div>
                <div class="modal-stat-label">Inactive</div>
            </div>
        `;
        actionBtn.textContent = 'View All Sellers';
        actionBtn.onclick = function() { window.location.href = "{{ route('admin.sellers.index') }}"; };
    } else if (title.includes('Orders')) {
        statsHTML += `
            <div class="modal-stat">
                <div class="modal-stat-value">05</div>
                <div class="modal-stat-label">Completed</div>
            </div>
            <div class="modal-stat">
                <div class="modal-stat-value">03</div>
                <div class="modal-stat-label">In Progress</div>
            </div>
        `;
        actionBtn.textContent = 'View All Orders';
        actionBtn.onclick = function() { showNotification('Orders page would open'); };
    } else {
        actionBtn.style.display = 'none';
    }
    
    modalStats.innerHTML = statsHTML;
    modal.style.display = 'flex';
}

function showDetailsModal(type, id) {
    const modal = document.getElementById('modalContainer');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalStats = document.getElementById('modalStats');
    const actionBtn = document.getElementById('actionModalBtn');
    
    modalTitle.textContent = `${type.charAt(0).toUpperCase() + type.slice(1)} Details`;
    modalDescription.textContent = `Detailed information for ${type} ID: ${id}`;
    
    // Sample details
    const detailsHTML = `
        <div class="${type}-details">
            <div class="detail-item">
                <div class="detail-label">${type.charAt(0).toUpperCase() + type.slice(1)} ID</div>
                <div class="detail-value">${id}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Name</div>
                <div class="detail-value">Abhishek yadav</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Company</div>
                <div class="detail-value">AP Logistics</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Status</div>
                <div class="detail-value" style="color: #28a745;">Active</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Total Products</div>
                <div class="detail-value">42</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Joined Date</div>
                <div class="detail-value">15-10-2024</div>
            </div>
        </div>
    `;
    
    modalStats.innerHTML = detailsHTML;
    actionBtn.textContent = `Edit ${type.charAt(0).toUpperCase() + type.slice(1)}`;
    actionBtn.onclick = function() {
        showNotification(`Edit ${type} functionality would open here`);
        closeModal();
    };
    actionBtn.style.display = 'block';
    
    modal.style.display = 'flex';
}

function closeModal() {
    const modal = document.getElementById('modalContainer');
    if (modal) {
        modal.style.display = 'none';
    }
}

// ====================
// REAL-TIME UPDATES
// ====================
function initRealTimeUpdates() {
    // Simulate real-time updates for new orders
    setInterval(() => {
        const newOrdersElement = document.querySelector('#newOrdersCard .stat-value');
        const manageOrdersElement = document.querySelector('#manageOrdersAction .list-value');
        
        if (newOrdersElement && manageOrdersElement) {
            const currentValue = parseInt(newOrdersElement.textContent) || 0;
            const randomChange = Math.random() > 0.7 ? 1 : (Math.random() > 0.5 ? 0 : -1);
            const newValue = Math.max(0, currentValue + randomChange);
            
            if (newValue !== currentValue) {
                newOrdersElement.textContent = newValue < 10 ? `0${newValue}` : newValue;
                manageOrdersElement.textContent = `${newValue < 10 ? `0${newValue}` : newValue} New`;
                
                // Update change indicator
                const changeElement = document.querySelector('#newOrdersCard .stat-change');
                if (changeElement) {
                    if (randomChange > 0) {
                        changeElement.textContent = `+${randomChange} from last hour`;
                        changeElement.classList.remove('negative');
                    } else if (randomChange < 0) {
                        changeElement.textContent = `${randomChange} from last hour`;
                        changeElement.classList.add('negative');
                    }
                }
            }
        }
    }, 15000); // Update every 15 seconds
}

// ====================
// UTILITY FUNCTIONS
// ====================
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close">&times;</button>
    `;
    
    // Add styles if not already added
    if (!document.getElementById('notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.15);
                padding: 15px 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                min-width: 300px;
                max-width: 400px;
                z-index: 9999;
                animation: slideIn 0.3s ease;
                border-left: 4px solid #4361ee;
            }
            .notification-success { border-left-color: #28a745; }
            .notification-error { border-left-color: #e53935; }
            .notification-warning { border-left-color: #ffc107; }
            .notification-content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .notification-content i {
                font-size: 18px;
            }
            .notification-close {
                background: none;
                border: none;
                font-size: 20px;
                cursor: pointer;
                color: #666;
                padding: 0;
                margin-left: 15px;
            }
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // Add close functionality
    notification.querySelector('.notification-close').addEventListener('click', function() {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

function addRippleEffect(element) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.7);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        width: ${size}px;
        height: ${size}px;
        top: ${y}px;
        left: ${x}px;
        pointer-events: none;
    `;
    
    element.style.position = 'relative';
    element.style.overflow = 'hidden';
    element.appendChild(ripple);
    
    setTimeout(() => ripple.remove(), 600);
}

// Add ripple animation CSS
if (!document.getElementById('ripple-styles')) {
    const style = document.createElement('style');
    style.id = 'ripple-styles';
    style.textContent = `
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// ====================
// WINDOW EXPORTS
// ====================
// Make functions available globally
window.showNotification = showNotification;
window.handleProfileAction = handleProfileAction;
window.closeModal = closeModal;
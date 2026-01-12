// DOM Elements
const searchInput = document.getElementById('searchInput');
const productsTableBody = document.getElementById('productsTableBody');
const productModal = document.getElementById('productModal');
const closeModal = document.getElementById('closeModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const productDetailsContent = document.getElementById('productDetailsContent');
const editProductBtn = document.getElementById('editProductBtn');

// Search functionality
if (searchInput && productsTableBody) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = productsTableBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const productName = row.querySelector('.product-name').textContent.toLowerCase();
            const productCategory = row.querySelector('.product-category').textContent.toLowerCase();
            
            if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
}

// Modal functionality
if (closeModal) {
    closeModal.addEventListener('click', function() {
        if (productModal) {
            productModal.style.display = 'none';
        }
    });
}

if (closeModalBtn) {
    closeModalBtn.addEventListener('click', function() {
        if (productModal) {
            productModal.style.display = 'none';
        }
    });
}

if (editProductBtn) {
    editProductBtn.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        if (productId) {
            window.location.href = `/admin/products/${productId}/edit`;
        }
    });
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (productModal && e.target === productModal) {
        productModal.style.display = 'none';
    }
});

// Function to show product details
function showProductDetails(productId) {
    // In a real application, you would fetch product details via AJAX
    // For now, redirect to the show page
    window.location.href = `/admin/products/${productId}`;
}
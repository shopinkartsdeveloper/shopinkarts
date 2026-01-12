// DOM Elements
const categoryTree = document.querySelector('.category-tree');

// Expand/collapse category tree nodes
if (categoryTree) {
    categoryTree.addEventListener('click', function(e) {
        if (e.target.closest('.tree-node')) {
            const node = e.target.closest('.tree-node');
            const parent = node.closest('.tree-parent');
            const children = parent.querySelectorAll('.tree-child');
            
            children.forEach(child => {
                child.style.display = child.style.display === 'none' ? 'block' : 'none';
            });
            
            // Toggle icon
            const icon = node.querySelector('i');
            if (icon.classList.contains('fa-folder')) {
                icon.classList.remove('fa-folder');
                icon.classList.add('fa-folder-open');
            } else if (icon.classList.contains('fa-folder-open')) {
                icon.classList.remove('fa-folder-open');
                icon.classList.add('fa-folder');
            }
        }
    });
}
@extends('admin.layouts.master')

@section('title', 'Manage Categories')
@section('page-title', 'Admin Categories Screen 1')
@section('page-description', 'Manage Categories Data Table')
@section('page-subtitle', 'Admin Categories')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/category.css') }}">
@endsection

@section('content')
    <!-- Categories Data Table Section -->
    <div class="data-table-section">
        <div class="section-title-bar">
            <h3 class="section-title">All Categories</h3>
            
            <a href="{{ route('admin.categories.create') }}" class="add-category-btn">
                <i class="fas fa-plus"></i>
                Add Category
            </a>
        </div>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>C. ID</th>
                        <th>Category Name</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="categoriesTableBody">
                    @foreach($categories as $cat)
                    <tr>
                        <td class="category-id">#{{ str_pad($cat->id, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="category-name">{{ $cat->name }}</td>
                        <td class="parent-category {{ $cat->parent_id ? '' : 'no-parent' }}">
                            {{ $cat->parent ? $cat->parent->name : '---' }}
                        </td>
                        <td>
                            <span class="status-badge {{ $cat->is_active ? 'active' : 'inactive' }}">
                                {{ $cat->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-icons">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="action-icon edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-icon delete" onclick="deleteCategory({{ $cat->id }}, '{{ $cat->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="pagination">
            <div class="pagination-info">
                @if($categories->count() > 0)
                    Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries
                @else
                    Showing 0 to 0 of 0 entries
                @endif
            </div>
            
            <div class="pagination-controls">
                {{ $categories->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    
    <!-- Category Hierarchy Tree -->
    <div class="data-table-section" style="margin-top: 30px;">
        <div class="section-title-bar">
            <h3 class="section-title">Category Hierarchy</h3>
        </div>
        <div class="category-tree" style="margin-top: 20px;">
            @php
                $parentCategories = $categories->where('parent_id', null);
            @endphp
            
            @foreach($parentCategories as $parentCat)
                <div class="tree-parent">
                    <div class="tree-node">
                        <i class="fas fa-folder"></i>
                        <span>{{ $parentCat->name }}</span>
                        <span class="tree-badge">{{ $parentCat->products_count ?? 0 }} products</span>
                    </div>
                    @php
                        $childCategories = $categories->where('parent_id', $parentCat->id);
                    @endphp
                    
                    @foreach($childCategories as $childCat)
                        <div class="tree-child">
                            <div class="tree-node">
                                <i class="fas fa-folder-open"></i>
                                <span>{{ $childCat->name }}</span>
                                <span class="tree-badge">{{ $childCat->products_count ?? 0 }} products</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/js/category.js') }}"></script>
    <script>
        function deleteCategory(categoryId, categoryName) {
            if (confirm(`Are you sure you want to delete "${categoryName}"?`)) {
                event.target.closest('form').submit();
            }
        }
    </script>
@endsection
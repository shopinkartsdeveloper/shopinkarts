@extends('admin.layouts.master')

@section('title', 'Manage Categories')

@section('content')
<div class="content-header">
    <h2>Manage Categories</h2>

    <!-- Add Category Button -->
    <button class="btn btn-primary" onclick="document.getElementById('addCategoryForm').style.display='block'">
        + Add Category
    </button>
</div>

<!-- Add Category Form -->
<div id="addCategoryForm" style="display:none; margin:20px 0;">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Category Name" required>
        <button class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary"
            onclick="document.getElementById('addCategoryForm').style.display='none'">
            Cancel
        </button>
    </form>
</div>

@if($categories->count() === 0)
    <!-- Empty State -->
    <div class="empty-box">
        <p>No categories available.</p>
        <p>Please add a new category.</p>
    </div>
@else
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>
                {{ $cat->is_active ? 'Active' : 'Inactive' }}
            </td>
            <td>
                <!-- DELETE -->
                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this category?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection

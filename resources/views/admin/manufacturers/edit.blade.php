@extends('admin.layouts.master')

@section('title', 'Edit Manufacturer')
@section('page_title', 'Edit Manufacturer')
@section('page_subtitle', 'Edit manufacturer details')

@section('content')
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Edit Manufacturer</h3>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.manufacturers.update', $manufacturer->id) }}" method="POST" id="editManufacturerForm">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="first_name">First Name *</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" 
                           value="{{ old('first_name', $manufacturer->first_name) }}" required>
                    @error('first_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="last_name">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" 
                           value="{{ old('last_name', $manufacturer->last_name) }}" required>
                    @error('last_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="mobile_number">Mobile Number *</label>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" 
                           value="{{ old('mobile_number', $manufacturer->mobile_number) }}" required>
                    @error('mobile_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email ID *</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email', $manufacturer->email) }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">New Password (Leave blank to keep current)</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="whatsapp_number">Whatsapp Number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" 
                           value="{{ old('whatsapp_number', $manufacturer->whatsapp_number) }}">
                    <div class="checkbox-container" style="margin-top: 8px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" id="same_as_mobile" style="width: auto;">
                            <span style="font-size: 13px; color: #666;">Same as mobile number</span>
                        </label>
                    </div>
                    @error('whatsapp_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="firm_name">Firm Name *</label>
                    <input type="text" name="firm_name" id="firm_name" class="form-control" 
                           value="{{ old('firm_name', $manufacturer->firm_name) }}" required>
                    @error('firm_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="gst_number">GST Number</label>
                    <input type="text" name="gst_number" id="gst_number" class="form-control" 
                           value="{{ old('gst_number', $manufacturer->gst_number) }}">
                    @error('gst_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="shop_name">Shop Name (Meesho) *</label>
                    <input type="text" name="shop_name" id="shop_name" class="form-control" 
                           value="{{ old('shop_name', $manufacturer->shop_name) }}" required>
                    @error('shop_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="form-control" 
                           value="{{ old('company_name', $manufacturer->company_name) }}">
                    @error('company_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ old('status', $manufacturer->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $manufacturer->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="pending" {{ old('status', $manufacturer->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-actions">
                <a href="{{ route('admin.manufacturers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Manufacturer</button>
                
                @if($manufacturer->trashed())
                    <button type="button" class="btn btn-success" onclick="restoreManufacturer({{ $manufacturer->id }})">
                        <i class="fas fa-undo"></i> Restore
                    </button>
                    <button type="button" class="btn btn-danger" onclick="forceDeleteManufacturer({{ $manufacturer->id }})">
                        <i class="fas fa-trash-alt"></i> Delete Permanently
                    </button>
                @else
                    <button type="button" class="btn btn-danger" onclick="deleteManufacturer({{ $manufacturer->id }})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-container {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    
    .error-message {
        color: #e53935;
        font-size: 12px;
        margin-top: 5px;
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 12px 30px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-primary {
        background-color: #4361ee;
        color: white;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    
    .btn-danger {
        background-color: #e53935;
        color: white;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileInput = document.getElementById('mobile_number');
        const whatsappInput = document.getElementById('whatsapp_number');
        const sameAsMobileCheckbox = document.getElementById('same_as_mobile');
        
        if (mobileInput && whatsappInput && sameAsMobileCheckbox) {
            // Check if whatsapp number is same as mobile number
            if (whatsappInput.value === mobileInput.value) {
                sameAsMobileCheckbox.checked = true;
                whatsappInput.disabled = true;
            }
            
            // Handle checkbox change
            sameAsMobileCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    whatsappInput.value = mobileInput.value;
                    whatsappInput.disabled = true;
                } else {
                    whatsappInput.value = '';
                    whatsappInput.disabled = false;
                }
            });
            
            // Handle mobile number change
            mobileInput.addEventListener('input', function() {
                if (sameAsMobileCheckbox.checked) {
                    whatsappInput.value = this.value;
                }
            });
        }
        
        // Form submission handler
        const form = document.getElementById('editManufacturerForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Enable all disabled inputs before submission
                const disabledInputs = form.querySelectorAll('input:disabled');
                disabledInputs.forEach(input => {
                    input.disabled = false;
                });
                
                // Validate form
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.add('was-validated');
                }
            });
        }
    });
    
    // Delete manufacturer function
    function deleteManufacturer(id) {
        if (confirm('Are you sure you want to delete this manufacturer?')) {
            fetch(`/admin/manufacturers/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/admin/manufacturers';
                } else {
                    alert('Error deleting manufacturer. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting manufacturer. Please try again.');
            });
        }
    }
    
    // Restore manufacturer function
    function restoreManufacturer(id) {
        if (confirm('Are you sure you want to restore this manufacturer?')) {
            fetch(`/admin/manufacturers/${id}/restore`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/admin/manufacturers';
                } else {
                    alert('Error restoring manufacturer. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error restoring manufacturer. Please try again.');
            });
        }
    }
    
    // Force delete manufacturer function
    function forceDeleteManufacturer(id) {
        if (confirm('Permanently delete this manufacturer? This cannot be undone!')) {
            fetch(`/admin/manufacturers/${id}/force-delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/admin/manufacturers';
                } else {
                    alert('Error permanently deleting manufacturer. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error permanently deleting manufacturer. Please try again.');
            });
        }
    }
</script>
@endpush
@extends('admin.layouts.master')

@section('title', 'Add New Manufacturer')
@section('page_title', 'Add New Manufacturer')
@section('page_subtitle', 'Add new manufacturer to the system')

@section('content')
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Add New Manufacturer</h3>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.manufacturers.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="first_name">First Name *</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" 
                           value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="last_name">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" 
                           value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="mobile_number">Mobile Number *</label>
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" 
                        value="{{ old('mobile_number') }}" required>
                    @error('mobile_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email ID *</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="whatsapp_number">Whatsapp Number</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" 
                        value="{{ old('whatsapp_number') }}">
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
                           value="{{ old('firm_name') }}" required>
                    @error('firm_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="gst_number">GST Number</label>
                    <input type="text" name="gst_number" id="gst_number" class="form-control" 
                           value="{{ old('gst_number') }}">
                    @error('gst_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="shop_name">Shop Name (Meesho) *</label>
                    <input type="text" name="shop_name" id="shop_name" class="form-control" 
                           value="{{ old('shop_name') }}" required>
                    @error('shop_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="form-control" 
                           value="{{ old('company_name') }}">
                    @error('company_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-actions">
                <a href="{{ route('admin.manufacturers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Manufacturer</button>
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
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // WhatsApp same as mobile checkbox functionality
        const mobileInput = document.getElementById('mobile_number');
        const whatsappInput = document.getElementById('whatsapp_number');
        const sameAsMobileCheckbox = document.getElementById('same_as_mobile');
        
        if (mobileInput && whatsappInput && sameAsMobileCheckbox) {
            // Initialize - check if whatsapp is empty or same as mobile
            if (!whatsappInput.value || whatsappInput.value === mobileInput.value) {
                sameAsMobileCheckbox.checked = true;
                whatsappInput.value = mobileInput.value;
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
                    whatsappInput.focus();
                }
            });
            
            // Handle mobile number change - update whatsapp if checkbox is checked
            mobileInput.addEventListener('input', function() {
                if (sameAsMobileCheckbox.checked) {
                    whatsappInput.value = this.value;
                }
            });
            
            // Handle whatsapp input - uncheck if user manually types different number
            whatsappInput.addEventListener('input', function() {
                if (this.value !== mobileInput.value) {
                    sameAsMobileCheckbox.checked = false;
                    whatsappInput.disabled = false;
                }
            });
        }
        
        // Form validation and submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Ensure whatsapp number is filled if checkbox is checked
                if (sameAsMobileCheckbox && sameAsMobileCheckbox.checked) {
                    whatsappInput.disabled = false;
                }
                
                // Additional validation
                const mobileNumber = mobileInput.value.trim();
                const email = document.getElementById('email').value.trim();
                
                if (!mobileNumber || mobileNumber.length < 10) {
                    e.preventDefault();
                    alert('Please enter a valid mobile number (at least 10 digits).');
                    mobileInput.focus();
                    return false;
                }
                
                if (!email || !isValidEmail(email)) {
                    e.preventDefault();
                    alert('Please enter a valid email address.');
                    document.getElementById('email').focus();
                    return false;
                }
            });
        }
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        // Real-time validation
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
        
        function validateField(field) {
            const value = field.value.trim();
            const fieldId = field.id;
            
            if (field.hasAttribute('required') && !value) {
                showError(field, 'This field is required.');
                return false;
            }
            
            if (fieldId === 'email' && value && !isValidEmail(value)) {
                showError(field, 'Invalid email format.');
                return false;
            }
            
            if (fieldId === 'mobile_number' && value && value.length < 10) {
                showError(field, 'Mobile number must be at least 10 digits.');
                return false;
            }
            
            clearError(field);
            return true;
        }
        
        function showError(field, message) {
            clearError(field);
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'input-error';
            errorDiv.style.color = '#e53935';
            errorDiv.style.fontSize = '12px';
            errorDiv.style.marginTop = '5px';
            errorDiv.textContent = message;
            
            field.parentNode.appendChild(errorDiv);
            field.style.borderColor = '#e53935';
        }
        
        function clearError(field) {
            const existingError = field.parentNode.querySelector('.input-error');
            if (existingError) {
                existingError.remove();
            }
            field.style.borderColor = '#ddd';
        }
        
        // Password validation
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        
        if (passwordInput && confirmPasswordInput) {
            passwordInput.addEventListener('input', updatePasswordStrength);
            confirmPasswordInput.addEventListener('input', checkPasswordConfirmation);
        }
        
        function updatePasswordStrength() {
            const password = passwordInput.value;
            const strengthDiv = document.getElementById('password-strength') || createPasswordStrengthDiv();
            
            let strength = 0;
            let message = 'Weak';
            let color = '#e53935';
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            if (strength >= 4) {
                message = 'Strong';
                color = '#28a745';
            } else if (strength >= 2) {
                message = 'Medium';
                color = '#ff9800';
            }
            
            strengthDiv.textContent = `Password strength: ${message}`;
            strengthDiv.style.color = color;
        }
        
        function createPasswordStrengthDiv() {
            const div = document.createElement('div');
            div.id = 'password-strength';
            div.style.fontSize = '12px';
            div.style.marginTop = '5px';
            passwordInput.parentNode.appendChild(div);
            return div;
        }
        
        function checkPasswordConfirmation() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const matchDiv = document.getElementById('password-match') || createPasswordMatchDiv();
            
            if (!password || !confirmPassword) {
                matchDiv.textContent = '';
                return;
            }
            
            if (password === confirmPassword) {
                matchDiv.textContent = '✓ Passwords match';
                matchDiv.style.color = '#28a745';
            } else {
                matchDiv.textContent = '✗ Passwords do not match';
                matchDiv.style.color = '#e53935';
            }
        }
        
        function createPasswordMatchDiv() {
            const div = document.createElement('div');
            div.id = 'password-match';
            div.style.fontSize = '12px';
            div.style.marginTop = '5px';
            confirmPasswordInput.parentNode.appendChild(div);
            return div;
        }
        
        // Auto-format mobile numbers
        const mobileFields = document.querySelectorAll('input[name="mobile_number"], input[name="whatsapp_number"]');
        mobileFields.forEach(field => {
            field.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                this.value = value;
            });
        });
        
        // GST number formatting
        const gstInput = document.getElementById('gst_number');
        if (gstInput) {
            gstInput.addEventListener('input', function() {
                let value = this.value.toUpperCase().replace(/\s/g, '');
                if (value.length > 15) {
                    value = value.substring(0, 15);
                }
                this.value = value;
            });
        }
    });
</script>
@endpush
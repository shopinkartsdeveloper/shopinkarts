@extends('admin.layouts.master')

@section('title', 'Add New Seller')
@section('page_title', 'Add New Seller')
@section('page_subtitle', 'Add new seller to the system')

@section('content')
<div class="data-table-section">
    <div class="section-title-bar">
        <h3 class="section-title">Add New Seller</h3>
    </div>
    
    <div class="form-container">
        <form action="{{ route('admin.sellers.store') }}" method="POST">
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
                <a href="{{ route('admin.sellers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Seller</button>
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
                
                // Additional validation if needed
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
        
        // Real-time validation feedback
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearValidationError(this);
            });
        });
        
        function validateField(field) {
            const value = field.value.trim();
            const fieldId = field.id;
            
            if (field.hasAttribute('required') && !value) {
                showValidationError(field, 'This field is required.');
                return false;
            }
            
            if (fieldId === 'email' && value && !isValidEmail(value)) {
                showValidationError(field, 'Please enter a valid email address.');
                return false;
            }
            
            if (fieldId === 'mobile_number' && value && value.length < 10) {
                showValidationError(field, 'Mobile number must be at least 10 digits.');
                return false;
            }
            
            if (fieldId === 'password' && value && value.length < 8) {
                showValidationError(field, 'Password must be at least 8 characters.');
                return false;
            }
            
            clearValidationError(field);
            return true;
        }
        
        function showValidationError(field, message) {
            clearValidationError(field);
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'validation-error';
            errorDiv.style.color = '#e53935';
            errorDiv.style.fontSize = '12px';
            errorDiv.style.marginTop = '5px';
            errorDiv.textContent = message;
            
            field.parentNode.appendChild(errorDiv);
            field.style.borderColor = '#e53935';
        }
        
        function clearValidationError(field) {
            const existingError = field.parentNode.querySelector('.validation-error');
            if (existingError) {
                existingError.remove();
            }
            field.style.borderColor = '#ddd';
        }
        
        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const strength = checkPasswordStrength(this.value);
                updatePasswordStrengthIndicator(strength);
            });
        }
        
        if (passwordInput && confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', function() {
                checkPasswordMatch();
            });
        }
        
        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            return strength;
        }
        
        function updatePasswordStrengthIndicator(strength) {
            const indicator = document.getElementById('password-strength') || createPasswordStrengthIndicator();
            
            let message = '';
            let color = '#e53935';
            
            if (strength <= 2) {
                message = 'Weak';
                color = '#e53935';
            } else if (strength <= 4) {
                message = 'Medium';
                color = '#ff9800';
            } else {
                message = 'Strong';
                color = '#28a745';
            }
            
            indicator.textContent = `Password strength: ${message}`;
            indicator.style.color = color;
        }
        
        function createPasswordStrengthIndicator() {
            const passwordGroup = document.querySelector('input[name="password"]').parentNode;
            const indicator = document.createElement('div');
            indicator.id = 'password-strength';
            indicator.style.fontSize = '12px';
            indicator.style.marginTop = '5px';
            passwordGroup.appendChild(indicator);
            return indicator;
        }
        
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const matchIndicator = document.getElementById('password-match') || createPasswordMatchIndicator();
            
            if (!password || !confirmPassword) {
                matchIndicator.textContent = '';
                return;
            }
            
            if (password === confirmPassword) {
                matchIndicator.textContent = '✓ Passwords match';
                matchIndicator.style.color = '#28a745';
            } else {
                matchIndicator.textContent = '✗ Passwords do not match';
                matchIndicator.style.color = '#e53935';
            }
        }
        
        function createPasswordMatchIndicator() {
            const confirmGroup = document.querySelector('input[name="password_confirmation"]').parentNode;
            const indicator = document.createElement('div');
            indicator.id = 'password-match';
            indicator.style.fontSize = '12px';
            indicator.style.marginTop = '5px';
            confirmGroup.appendChild(indicator);
            return indicator;
        }
    });
</script>
@endpush
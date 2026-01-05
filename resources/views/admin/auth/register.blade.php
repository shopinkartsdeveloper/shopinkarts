<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopInKarts - Register as {{ ucfirst($type) }}</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        /* Register Card */
        .register-container {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Logo Section */
        .logo-section {
            background: linear-gradient(135deg, 
                @if($type == 'admin') #4361ee
                @elseif($type == 'seller') #4cc9f0
                @elseif($type == 'manufacturer') #4895ef
                @else #7209b7
                @endif, 
                @if($type == 'admin') #3a0ca3
                @elseif($type == 'seller') #3a86ff
                @elseif($type == 'manufacturer') #4361ee
                @else #560bad
                @endif);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .logo-section h1 {
            font-size: 28px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .logo-section p {
            font-size: 14px;
            opacity: 0.9;
        }

        .user-type-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            margin-top: 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Form Section */
        .form-section {
            padding: 30px;
        }

        /* Form Title */
        .form-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-title h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .form-title p {
            color: #666;
            font-size: 14px;
        }

        /* Input Fields */
        .input-group {
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }

        .input-field {
            position: relative;
        }

        .input-field input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .input-field input:focus {
            outline: none;
            border-color: 
                @if($type == 'admin') #4361ee
                @elseif($type == 'seller') #4cc9f0
                @elseif($type == 'manufacturer') #4895ef
                @else #7209b7
                @endif;
            background: white;
            box-shadow: 0 0 0 3px rgba(
                @if($type == 'admin') 67, 97, 238
                @elseif($type == 'seller') 76, 201, 240
                @elseif($type == 'manufacturer') 72, 149, 239
                @else 114, 9, 183
                @endif, 0.1);
        }

        .input-field .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 18px;
        }

        /* Form Row (for side-by-side inputs) */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, 
                @if($type == 'admin') #4361ee
                @elseif($type == 'seller') #4cc9f0
                @elseif($type == 'manufacturer') #4895ef
                @else #7209b7
                @endif, 
                @if($type == 'admin') #3a0ca3
                @elseif($type == 'seller') #3a86ff
                @elseif($type == 'manufacturer') #4361ee
                @else #560bad
                @endif);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(
                @if($type == 'admin') 67, 97, 238
                @elseif($type == 'seller') 76, 201, 240
                @elseif($type == 'manufacturer') 72, 149, 239
                @else 114, 9, 183
                @endif, 0.3);
        }

        /* Error Messages */
        .error-message {
            background: #ffe5e5;
            color: #d32f2f;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #d32f2f;
        }

        .input-error {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .login-link p {
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: 
                @if($type == 'admin') #4361ee
                @elseif($type == 'seller') #4cc9f0
                @elseif($type == 'manufacturer') #4895ef
                @else #7209b7
                @endif;
            font-weight: 600;
            text-decoration: none;
            margin-left: 5px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 5px;
            height: 4px;
            background: #eee;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ff4757; }
        .strength-fair { background: #ffa502; }
        .strength-good { background: #2ed573; }
        .strength-strong { background: #1e90ff; }

        .strength-text {
            font-size: 12px;
            color: #666;
            margin-top: 3px;
            text-align: right;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                max-width: 100%;
            }
            
            .form-section {
                padding: 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <h1>ShopInKarts</h1>
            <p>Create Your {{ ucfirst($type) }} Account</p>
            <div class="user-type-badge">
                <i class="fas 
                    @if($type == 'admin') fa-user-shield
                    @elseif($type == 'seller') fa-store
                    @elseif($type == 'manufacturer') fa-industry
                    @else fa-user
                    @endif
                "></i>
                {{ strtoupper($type) }}
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <!-- Form Title -->
            <div class="form-title">
                <h2>Register as {{ ucfirst($type) }}</h2>
                <p>Fill in your details to create an account</p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="error-message" style="background: #e7f7ef; color: #28a745; border-color: #28a745;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register.submit') }}" id="registerForm">
                @csrf
                
                <!-- Hidden type field -->
                <input type="hidden" name="type" value="{{ $type }}">

                <!-- Name Field -->
                <div class="input-group">
                    <label class="input-label" for="name">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <div class="input-field">
                        <i class="fas fa-user icon"></i>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Enter your full name"
                               required
                               autofocus>
                    </div>
                    @error('name')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="input-group">
                    <label class="input-label" for="email">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <div class="input-field">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="Enter your email address"
                               required>
                    </div>
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mobile Field -->
                <div class="input-group">
                    <label class="input-label" for="mobile">
                        <i class="fas fa-phone"></i> Mobile Number
                    </label>
                    <div class="input-field">
                        <i class="fas fa-phone icon"></i>
                        <input type="tel" 
                               id="mobile" 
                               name="mobile" 
                               value="{{ old('mobile') }}"
                               placeholder="Enter 10-digit mobile number"
                               pattern="[0-9]{10}"
                               maxlength="10"
                               required>
                    </div>
                    @error('mobile')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                    <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">
                        Enter without country code (e.g., 9876543210)
                    </small>
                </div>

                <!-- Password Fields -->
                <div class="form-row">
                    <div class="input-group">
                        <label class="input-label" for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-field">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Create password"
                                   required
                                   minlength="8">
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                        @error('password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label class="input-label" for="password_confirmation">
                            <i class="fas fa-lock"></i> Confirm Password
                        </label>
                        <div class="input-field">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Confirm password"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="input-group" style="margin-bottom: 25px;">
                    <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="terms" id="terms" required 
                               style="margin-top: 3px;">
                        <span style="font-size: 14px; color: #555;">
                            I agree to the <a href="#" style="color: #4361ee;">Terms & Conditions</a> 
                            and <a href="#" style="color: #4361ee;">Privacy Policy</a> of ShopInKarts
                        </span>
                    </label>
                    @error('terms')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-user-plus"></i> Register as {{ ucfirst($type) }}
                </button>
            </form>

            <!-- Login Link -->
            <div class="login-link">
                <p>Already have an account? 
                    <a href="{{ route('admin.login') }}">Login here</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            const submitBtn = document.getElementById('submitBtn');
            const mobileInput = document.getElementById('mobile');
            const form = document.getElementById('registerForm');
            
            // Mobile number formatting
            mobileInput.addEventListener('input', function() {
                // Remove non-digits
                this.value = this.value.replace(/\D/g, '');
                
                // Limit to 10 digits
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            });
            
            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let text = '';
                let color = '';
                
                // Check password strength
                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                
                // Update strength bar
                switch(strength) {
                    case 0:
                    case 1:
                        width = 25;
                        text = 'Weak';
                        color = 'strength-weak';
                        break;
                    case 2:
                        width = 50;
                        text = 'Fair';
                        color = 'strength-fair';
                        break;
                    case 3:
                        width = 75;
                        text = 'Good';
                        color = 'strength-good';
                        break;
                    case 4:
                    case 5:
                        width = 100;
                        text = 'Strong';
                        color = 'strength-strong';
                        break;
                }
                
                strengthBar.style.width = width + '%';
                strengthBar.className = 'strength-bar ' + color;
                strengthText.textContent = text;
            });
            
            // Password confirmation check
            confirmInput.addEventListener('input', function() {
                if (passwordInput.value !== this.value && this.value.length > 0) {
                    this.style.borderColor = '#ff4757';
                    this.style.boxShadow = '0 0 0 3px rgba(255, 71, 87, 0.1)';
                } else {
                    this.style.borderColor = '';
                    this.style.boxShadow = '';
                }
            });
            
            // Form validation
            form.addEventListener('submit', function(e) {
                // Check passwords match
                if (passwordInput.value !== confirmInput.value) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    confirmInput.focus();
                    return false;
                }
                
                // Check terms acceptance
                if (!document.getElementById('terms').checked) {
                    e.preventDefault();
                    alert('Please accept the Terms & Conditions');
                    return false;
                }
                
                // Check password strength
                if (passwordInput.value.length < 8) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long');
                    passwordInput.focus();
                    return false;
                }
                
                // Disable button to prevent double submission
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
                
                return true;
            });
            
            // Auto-format mobile number on blur
            mobileInput.addEventListener('blur', function() {
                if (this.value.length === 10) {
                    this.value = this.value.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                }
            });
            
            // Remove formatting on focus
            mobileInput.addEventListener('focus', function() {
                this.value = this.value.replace(/\D/g, '');
            });
            
            // Initialize password strength on page load
            if (passwordInput.value) {
                passwordInput.dispatchEvent(new Event('input'));
            }
        });
    </script>
</body>
</html>
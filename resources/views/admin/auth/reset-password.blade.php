<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopInKarts - Reset Password</title>
    
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

        /* Reset Password Card */
        .reset-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            position: relative;
        }

        /* Logo Section */
        .logo-section {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            padding: 40px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .logo-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.1;
        }

        .logo-section h1 {
            font-size: 36px;
            margin-bottom: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            position: relative;
            z-index: 2;
        }

        .logo-section p {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        /* Form Section */
        .form-section {
            padding: 35px;
        }

        /* Form Title */
        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title h2 {
            color: #333;
            font-size: 26px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-title p {
            color: #666;
            font-size: 15px;
            line-height: 1.5;
        }

        /* Input Fields */
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-field {
            position: relative;
        }

        .input-field input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            color: #333;
        }

        .input-field input:focus {
            outline: none;
            border-color: #4361ee;
            background: white;
            box-shadow: 0 5px 20px rgba(67, 97, 238, 0.15);
            transform: translateY(-2px);
        }

        .input-field .icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 18px;
            z-index: 2;
        }

        /* Show Password Toggle */
        .show-password {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            z-index: 2;
            transition: all 0.3s ease;
            background: transparent;
            border: none;
            padding: 5px;
        }

        .show-password:hover {
            color: #4361ee;
            transform: translateY(-50%) scale(1.1);
        }

        /* Password Strength */
        .password-strength {
            margin-top: 10px;
            height: 4px;
            background: #e1e5e9;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 2px;
            position: absolute;
            top: 0;
            left: 0;
        }

        .strength-weak { background: #ff4757; }
        .strength-fair { background: #ffa502; }
        .strength-good { background: #2ed573; }
        .strength-strong { background: #1e90ff; }

        .strength-text {
            font-size: 12px;
            color: #64748b;
            margin-top: 5px;
            text-align: right;
            font-weight: 500;
        }

        /* Helper Text */
        .helper-text {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 13px;
            font-style: italic;
            line-height: 1.4;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-left: 5px solid #0ea5e9;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .info-box p {
            color: #0369a1;
            font-size: 14px;
            line-height: 1.5;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Hidden Fields */
        .hidden-fields {
            display: none;
        }

        /* Buttons Container */
        .buttons-container {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .submit-btn {
            flex: 2;
            padding: 16px;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.4);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .back-btn {
            flex: 1;
            padding: 16px;
            background: #f1f5f9;
            color: #64748b;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .back-btn:hover {
            background: #e1e5e9;
            transform: translateY(-2px);
        }

        /* Error Messages */
        .error-message {
            background: linear-gradient(135deg, #ffe5e5, #ffcccc);
            color: #d32f2f;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            border-left: 5px solid #d32f2f;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        .input-error {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 8px;
            display: block;
            font-weight: 500;
            padding-left: 5px;
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, #e7f7ef, #d4f1e1);
            color: #28a745;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            border-left: 5px solid #28a745;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 2px solid #f1f5f9;
        }

        .login-link p {
            color: #666;
            font-size: 15px;
        }

        .login-link a {
            color: #4361ee;
            font-weight: 700;
            text-decoration: none;
            margin-left: 5px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .reset-container {
                max-width: 100%;
                margin: 10px;
            }
            
            .form-section {
                padding: 25px;
            }
            
            .buttons-container {
                flex-direction: column;
            }
            
            .logo-section {
                padding: 30px 20px;
            }
            
            .logo-section h1 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <h1>ShopInKarts</h1>
            <p>Set New Password</p>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <!-- Form Title -->
            <div class="form-title">
                <h2>Reset Password</h2>
                <p>Create a new password for your account</p>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p>
                    <i class="fas fa-lock"></i>
                    Your new password must be at least 8 characters long and contain letters and numbers.
                </p>
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
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.update') }}" id="resetForm">
                @csrf

                <!-- Hidden Fields -->
                <div class="hidden-fields">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                </div>

                <!-- Email Field (Readonly) -->
                <div class="input-group">
                    <label class="input-label" for="email">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <div class="input-field">
                        <i class="fas fa-envelope icon"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ $email ?? old('email') }}"
                               placeholder="Your email address"
                               required
                               readonly
                               style="background: #f1f5f9; color: #64748b;">
                    </div>
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password Field -->
                <div class="input-group">
                    <label class="input-label" for="password">
                        <i class="fas fa-lock"></i> New Password
                    </label>
                    <div class="input-field">
                        <i class="fas fa-key icon"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Enter new password"
                               required
                               minlength="8">
                        <button type="button" class="show-password" id="togglePassword1">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="strengthBar1"></div>
                    </div>
                    <div class="strength-text" id="strengthText1">Password strength</div>
                    <span class="helper-text">Must be at least 8 characters with letters and numbers</span>
                    @error('password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="input-group">
                    <label class="input-label" for="password_confirmation">
                        <i class="fas fa-lock"></i> Confirm Password
                    </label>
                    <div class="input-field">
                        <i class="fas fa-key icon"></i>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Confirm new password"
                               required>
                        <button type="button" class="show-password" id="togglePassword2">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="strengthBar2"></div>
                    </div>
                    <div class="strength-text" id="strengthText2">Passwords match</div>
                    @error('password_confirmation')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="buttons-container">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sync-alt"></i> Reset Password
                    </button>
                    <a href="{{ route('login') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
                </div>
            </form>

            <!-- Login Link -->
            <div class="login-link">
                <p>Remember your password? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput1 = document.getElementById('password');
            const passwordInput2 = document.getElementById('password_confirmation');
            const togglePassword1 = document.getElementById('togglePassword1');
            const togglePassword2 = document.getElementById('togglePassword2');
            const eyeIcon1 = togglePassword1.querySelector('i');
            const eyeIcon2 = togglePassword2.querySelector('i');
            const strengthBar1 = document.getElementById('strengthBar1');
            const strengthBar2 = document.getElementById('strengthBar2');
            const strengthText1 = document.getElementById('strengthText1');
            const strengthText2 = document.getElementById('strengthText2');
            const resetForm = document.getElementById('resetForm');
            
            // Toggle password visibility for first password
            togglePassword1.addEventListener('click', function() {
                const type = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput1.setAttribute('type', type);
                
                // Toggle eye icon
                eyeIcon1.classList.toggle('fa-eye');
                eyeIcon1.classList.toggle('fa-eye-slash');
                
                // Add focus to password field
                passwordInput1.focus();
            });
            
            // Toggle password visibility for second password
            togglePassword2.addEventListener('click', function() {
                const type = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput2.setAttribute('type', type);
                
                // Toggle eye icon
                eyeIcon2.classList.toggle('fa-eye');
                eyeIcon2.classList.toggle('fa-eye-slash');
                
                // Add focus to password field
                passwordInput2.focus();
            });
            
            // Password strength checker for first password
            passwordInput1.addEventListener('input', function() {
                const password = this.value;
                checkPasswordStrength(password, strengthBar1, strengthText1);
                checkPasswordMatch();
            });
            
            // Password match checker for second password
            passwordInput2.addEventListener('input', function() {
                checkPasswordMatch();
            });
            
            // Function to check password strength
            function checkPasswordStrength(password, strengthBar, strengthText) {
                let strength = 0;
                let text = '';
                let color = '';
                
                // Check password strength
                if (password.length >= 8) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                
                // Update strength bar and text
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
                strengthText.style.color = getComputedStyle(strengthBar).backgroundColor;
            }
            
            // Function to check if passwords match
            function checkPasswordMatch() {
                const password1 = passwordInput1.value;
                const password2 = passwordInput2.value;
                
                if (password2.length === 0) {
                    strengthBar2.style.width = '0%';
                    strengthText2.textContent = 'Confirm password';
                    strengthText2.style.color = '#64748b';
                    return;
                }
                
                if (password1 === password2 && password1.length >= 8) {
                    strengthBar2.style.width = '100%';
                    strengthBar2.className = 'strength-bar strength-strong';
                    strengthText2.textContent = 'Passwords match ✓';
                    strengthText2.style.color = '#2ed573';
                } else if (password1 === password2) {
                    strengthBar2.style.width = '50%';
                    strengthBar2.className = 'strength-bar strength-fair';
                    strengthText2.textContent = 'Passwords match but too short';
                    strengthText2.style.color = '#ffa502';
                } else {
                    strengthBar2.style.width = '25%';
                    strengthBar2.className = 'strength-bar strength-weak';
                    strengthText2.textContent = 'Passwords do not match';
                    strengthText2.style.color = '#ff4757';
                }
            }
            
            // Form validation
            resetForm.addEventListener('submit', function(e) {
                const password1 = passwordInput1.value;
                const password2 = passwordInput2.value;
                
                // Check passwords match
                if (password1 !== password2) {
                    e.preventDefault();
                    showAlert('Passwords do not match!', 'error');
                    passwordInput2.focus();
                    return false;
                }
                
                // Check password strength
                if (password1.length < 8) {
                    e.preventDefault();
                    showAlert('Password must be at least 8 characters long', 'error');
                    passwordInput1.focus();
                    return false;
                }
                
                // Check if password contains both letters and numbers
                if (!/[a-zA-Z]/.test(password1) || !/[0-9]/.test(password1)) {
                    e.preventDefault();
                    showAlert('Password must contain both letters and numbers', 'error');
                    passwordInput1.focus();
                    return false;
                }
                
                // Change button text to show loading
                const submitBtn = this.querySelector('.submit-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting...';
                submitBtn.disabled = true;
                
                // Re-enable button after 5 seconds (in case of error)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
                
                return true;
            });
            
            // Initialize password strength check
            if (passwordInput1.value) {
                passwordInput1.dispatchEvent(new Event('input'));
            }
            
            // Alert function
            function showAlert(message, type = 'info') {
                // Create alert element
                const alert = document.createElement('div');
                alert.className = `alert alert-${type}`;
                alert.innerHTML = `
                    <div style="position: fixed; top: 20px; right: 20px; background: ${type === 'error' ? '#d32f2f' : '#4361ee'}; 
                         color: white; padding: 15px 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); 
                         display: flex; align-items: center; gap: 10px; z-index: 10000; animation: slideInRight 0.3s ease;">
                        <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `;
                
                document.body.appendChild(alert);
                
                // Remove alert after 3 seconds
                setTimeout(() => {
                    alert.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => alert.remove(), 300);
                }, 3000);
                
                // Add CSS for animations
                if (!document.querySelector('#alert-styles')) {
                    const style = document.createElement('style');
                    style.id = 'alert-styles';
                    style.textContent = `
                        @keyframes slideInRight {
                            from { transform: translateX(100%); opacity: 0; }
                            to { transform: translateX(0); opacity: 1; }
                        }
                        @keyframes slideOutRight {
                            from { transform: translateX(0); opacity: 1; }
                            to { transform: translateX(100%); opacity: 0; }
                        }
                    `;
                    document.head.appendChild(style);
                }
            }
        });
    </script>
</body>
</html>
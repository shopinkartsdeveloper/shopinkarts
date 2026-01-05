<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopInKarts - Forgot Password</title>
    
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

        /* Forgot Password Card */
        .forgot-container {
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

        /* For testing: Show reset link */
        .reset-link-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-left: 5px solid #f59e0b;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            word-break: break-all;
        }

        .reset-link-box h4 {
            color: #92400e;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reset-link-box a {
            color: #0369a1;
            font-size: 13px;
            text-decoration: none;
            word-break: break-all;
        }

        .reset-link-box a:hover {
            text-decoration: underline;
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
            .forgot-container {
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
    <div class="forgot-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <h1>ShopInKarts</h1>
            <p>Reset Your Password</p>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <!-- Form Title -->
            <div class="form-title">
                <h2>Forgot Password?</h2>
                <p>Enter your email or mobile number to receive a password reset link</p>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p>
                    <i class="fas fa-info-circle"></i>
                    We will send a password reset link to your registered email address.
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

            <!-- For testing: Show reset link -->
            @if(session('reset_link'))
                <div class="reset-link-box">
                    <h4><i class="fas fa-link"></i> Test Reset Link (For Development Only):</h4>
                    <a href="{{ session('reset_link') }}" target="_blank">{{ session('reset_link') }}</a>
                    <p style="margin-top: 8px; font-size: 12px; color: #92400e;">
                        <i class="fas fa-exclamation-triangle"></i>
                        In production, this link would be sent to your email.
                    </p>
                </div>
            @endif

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
                @csrf

                <!-- Email/Mobile Field -->
                <div class="input-group">
                    <label class="input-label" for="identifier">
                        <i class="fas fa-user"></i> Email or Mobile Number
                    </label>
                    <div class="input-field">
                        <i class="fas fa-envelope icon" id="identifierIcon"></i>
                        <input type="text" 
                               id="identifier" 
                               name="identifier" 
                               value="{{ old('identifier') }}"
                               placeholder="Enter email or 10-digit mobile"
                               required
                               autofocus>
                        <span class="helper-text">Enter the email or mobile number associated with your account</span>
                    </div>
                    @error('identifier')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="buttons-container">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> Send Reset Link
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
            const identifierInput = document.getElementById('identifier');
            const identifierIcon = document.getElementById('identifierIcon');
            const forgotForm = document.getElementById('forgotForm');
            
            // Detect input type and change icon
            identifierInput.addEventListener('input', function() {
                const value = this.value.trim();
                
                // Check if input looks like email
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                // Check if input looks like mobile (digits only)
                const mobilePattern = /^\d+$/;
                
                if (emailPattern.test(value)) {
                    identifierIcon.className = 'fas fa-envelope icon';
                    identifierInput.type = 'email';
                    identifierInput.placeholder = 'Enter your email address';
                } else if (mobilePattern.test(value)) {
                    identifierIcon.className = 'fas fa-phone icon';
                    identifierInput.type = 'tel';
                    identifierInput.placeholder = 'Enter 10-digit mobile number';
                    
                    // Auto-format mobile number
                    if (value.length === 10) {
                        this.value = value.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                    }
                } else {
                    identifierIcon.className = 'fas fa-user icon';
                    identifierInput.type = 'text';
                    identifierInput.placeholder = 'Enter email or 10-digit mobile';
                }
            });
            
            // Form validation
            forgotForm.addEventListener('submit', function(e) {
                const identifier = identifierInput.value.trim();
                
                // Basic validation
                if (!identifier) {
                    e.preventDefault();
                    showAlert('Please enter email or mobile number', 'error');
                    identifierInput.focus();
                    return false;
                }
                
                // Validate mobile format if it's a mobile number
                if (/^\d+$/.test(identifier.replace(/\D/g, ''))) {
                    const mobile = identifier.replace(/\D/g, '');
                    if (mobile.length !== 10) {
                        e.preventDefault();
                        showAlert('Please enter a valid 10-digit mobile number', 'error');
                        identifierInput.focus();
                        return false;
                    }
                }
                
                // Change button text to show loading
                const submitBtn = this.querySelector('.submit-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                submitBtn.disabled = true;
                
                // Re-enable button after 5 seconds (in case of error)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
                
                return true;
            });
            
            // Auto-format mobile number on blur
            identifierInput.addEventListener('blur', function() {
                const value = this.value.replace(/\D/g, '');
                if (value.length === 10) {
                    this.value = value.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                }
            });
            
            // Remove formatting on focus
            identifierInput.addEventListener('focus', function() {
                const value = this.value.replace(/\D/g, '');
                if (value.length === 10) {
                    this.value = value;
                }
            });
            
            // Auto-detect input type on page load
            if (identifierInput.value) {
                identifierInput.dispatchEvent(new Event('input'));
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
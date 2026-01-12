<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopInKarts - Login</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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

        /* Login Card */
        .login-container {
            width: 100%;
            max-width: 420px;
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

        .input-field input.error {
            border-color: #d32f2f;
            background: #fff5f5;
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

        /* Character Counter */
        .char-counter {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 12px;
            background: #f8fafc;
            padding: 2px 6px;
            border-radius: 3px;
            display: none;
        }

        .input-field input:focus + .char-counter {
            display: none;
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

        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            cursor: pointer;
            font-weight: 500;
        }

        .remember-me input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #4361ee;
        }

        .remember-me label {
            cursor: pointer;
        }

        .forgot-password {
            color: #4361ee;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 6px;
        }

        .forgot-password:hover {
            text-decoration: underline;
            background: #f1f5f9;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none !important;
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

        .submit-btn:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.4);
        }

        .submit-btn:hover:not(:disabled)::before {
            left: 100%;
        }

        .submit-btn:active:not(:disabled) {
            transform: translateY(0);
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

        /* Helper Text */
        .helper-text {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 12px;
            font-style: italic;
        }

        /* Real-time Validation Message */
        .validation-message {
            font-size: 12px;
            margin-top: 5px;
            padding-left: 5px;
            display: none;
        }

        .validation-message.valid {
            color: #28a745;
            display: block;
        }

        .validation-message.invalid {
            color: #d32f2f;
            display: block;
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
            .login-container {
                max-width: 100%;
                margin: 10px;
            }
            
            .form-section {
                padding: 25px;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .forgot-password {
                align-self: flex-end;
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
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <h1>ShopInKarts</h1>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <!-- Form Title -->
            <div class="form-title">
                <h2>Welcome Back</h2>
                <p>Login with email or mobile number</p>
            </div>

            <!-- Error Messages -->
            @if(session('error'))
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

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

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
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
                               autofocus
                               autocomplete="username">
                        <span class="char-counter" id="identifierCounter">0/60</span>
                    </div>
                    <div class="validation-message" id="identifierValidation"></div>
                    @error('identifier')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="input-group">
                    <label class="input-label" for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-field">
                        <i class="fas fa-key icon"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Enter your password"
                               required
                               minlength="8"
                               maxlength="50"
                               autocomplete="current-password">
                        <span class="char-counter" id="passwordCounter">0/50</span>
                        <button type="button" class="show-password" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="validation-message" id="passwordValidation"></div>
                    @error('password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>

                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                </button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const identifierInput = $('#identifier');
            const passwordInput = $('#password');
            const submitBtn = $('#submitBtn');
            const loginForm = $('#loginForm');
            const identifierIcon = $('#identifierIcon');
            const identifierValidation = $('#identifierValidation');
            const passwordValidation = $('#passwordValidation');
            const identifierCounter = $('#identifierCounter');
            const passwordCounter = $('#passwordCounter');
            
            // Character limits
            const MAX_EMAIL_LENGTH = 60;
            const MOBILE_LENGTH = 10;
            const MAX_PASSWORD_LENGTH = 50;
            
            // XSS Prevention function
            function sanitizeInput(input) {
                return input.replace(/[<>"'&]/g, '');
            }
            
            // Email validation regex - Allows numbers in email username
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            
            // Function to check if input is purely digits (mobile number)
            function isAllDigits(value) {
                return /^\d+$/.test(value);
            }
            
            // Function to check if input contains any letter or @ symbol (email)
            function containsLetterOrAtSymbol(value) {
                return /[a-zA-Z@]/.test(value);
            }
            
            // Function to detect input type
            function detectInputType(value) {
                // If it contains any letter or @ symbol, treat as email
                if (containsLetterOrAtSymbol(value)) {
                    return 'email';
                }
                // If it's all digits, treat as mobile
                else if (isAllDigits(value)) {
                    return 'mobile';
                }
                // For empty or mixed input, default to email
                else {
                    return 'email';
                }
            }
            
            // Function to update character counter
            function updateCharCounter(input, counter, maxLength) {
                const length = input.val().length;
                counter.text(`${length}/${maxLength}`);
                
                if (length > maxLength * 0.9) {
                    counter.css('color', '#d32f2f');
                } else if (length > maxLength * 0.7) {
                    counter.css('color', '#ffa502');
                } else {
                    counter.css('color', '#64748b');
                }
            }
            
            // Function to restrict mobile input to exactly 10 digits
            function restrictMobileInput(value) {
                // Remove all non-digit characters
                const digitsOnly = value.replace(/\D/g, '');
                // Take only first 10 digits
                return digitsOnly.slice(0, MOBILE_LENGTH);
            }
            
            // Function to restrict email input to max 60 characters
            function restrictEmailInput(value) {
                return value.slice(0, MAX_EMAIL_LENGTH);
            }
            
            // Function to validate identifier
            function validateIdentifier() {
                let value = identifierInput.val().trim();
                
                if (!value) {
                    identifierInput.addClass('error');
                    identifierValidation.removeClass('valid').addClass('invalid').text('Email or mobile number is required');
                    return false;
                }
                
                const inputType = detectInputType(value);
                
                if (inputType === 'mobile') {
                    const mobileValue = restrictMobileInput(value);
                    
                    if (mobileValue.length === MOBILE_LENGTH) {
                        identifierIcon.removeClass('fa-envelope').addClass('fa-phone');
                        identifierInput.removeClass('error');
                        identifierValidation.removeClass('invalid').addClass('valid').text('✓ Valid mobile number');
                        return true;
                    } else {
                        identifierIcon.removeClass('fa-envelope').addClass('fa-phone'); // Corrected: Keep phone icon for mobile
                        identifierInput.addClass('error');
                        identifierValidation.removeClass('valid').addClass('invalid').text(`Mobile number must be exactly ${MOBILE_LENGTH} digits (${mobileValue.length}/${MOBILE_LENGTH})`);
                        return false;
                    }
                } 
                else { // Email type
                    // Apply email length restriction
                    if (value.length > MAX_EMAIL_LENGTH) {
                        identifierIcon.removeClass('fa-phone').addClass('fa-envelope');
                        identifierInput.addClass('error');
                        identifierValidation.removeClass('valid').addClass('invalid').text(`Email must not exceed ${MAX_EMAIL_LENGTH} characters`);
                        return false;
                    }
                    
                    // Check if it's a valid email format when it contains @
                    if (value.includes('@')) {
                        if (emailRegex.test(value)) {
                            identifierIcon.removeClass('fa-phone').addClass('fa-envelope');
                            identifierInput.removeClass('error');
                            identifierValidation.removeClass('invalid').addClass('valid').text('✓ Valid email format');
                            return true;
                        } else {
                            identifierIcon.removeClass('fa-phone').addClass('fa-envelope');
                            identifierInput.addClass('error');
                            identifierValidation.removeClass('valid').addClass('invalid').text('Please enter a valid email address');
                            return false;
                        }
                    } else {
                        // User is still typing email (no @ yet)
                        identifierIcon.removeClass('fa-phone').addClass('fa-envelope');
                        identifierInput.removeClass('error');
                        identifierValidation.removeClass('invalid valid').text('');
                        return true;
                    }
                }
            }
            
            // Function to validate password
            function validatePassword() {
                const value = passwordInput.val();
                
                if (!value) {
                    passwordInput.addClass('error');
                    passwordValidation.removeClass('valid').addClass('invalid').text('Password is required');
                    return false;
                }
                
                if (value.length < 8) {
                    passwordInput.addClass('error');
                    passwordValidation.removeClass('valid').addClass('invalid').text('Password must be at least 8 characters');
                    return false;
                }
                
                if (value.length > MAX_PASSWORD_LENGTH) {
                    passwordInput.addClass('error');
                    passwordValidation.removeClass('valid').addClass('invalid').text(`Password is too long (max ${MAX_PASSWORD_LENGTH} characters)`);
                    return false;
                }
                
                // Basic XSS check for password
                if (/<[^>]*>|javascript:|on\w+=/i.test(value)) {
                    passwordInput.addClass('error');
                    passwordValidation.removeClass('valid').addClass('invalid').text('Invalid characters detected');
                    return false;
                }
                
                passwordInput.removeClass('error');
                passwordValidation.removeClass('invalid').addClass('valid').text('✓ Password looks good');
                return true;
            }
            
            // Handle identifier input with smart detection and restrictions
            identifierInput.on('input', function() {
                let value = $(this).val();
                const inputType = detectInputType(value);
                
                // Apply restrictions based on input type
                if (inputType === 'mobile') {
                    // Restrict to only 10 digits for mobile
                    const restrictedValue = restrictMobileInput(value);
                    $(this).val(restrictedValue);
                    
                    // Update counter for mobile
                    updateCharCounter($(this), identifierCounter, MOBILE_LENGTH);
                    
                    // Show mobile icon
                    identifierIcon.removeClass('fa-envelope').addClass('fa-phone');
                } 
                else { // Email type
                    // Restrict to max 60 characters for email
                    const restrictedValue = restrictEmailInput(value);
                    $(this).val(restrictedValue);
                    
                    // Update counter for email
                    updateCharCounter($(this), identifierCounter, MAX_EMAIL_LENGTH);
                    
                    // Show email icon
                    identifierIcon.removeClass('fa-phone').addClass('fa-envelope');
                }
                
                validateIdentifier();
                updateSubmitButton();
            });
            
            // Handle identifier keypress to enforce restrictions
            identifierInput.on('keypress', function(e) {
                let value = $(this).val();
                const charCode = e.which ? e.which : e.keyCode;
                const char = String.fromCharCode(charCode);
                const newValue = value + char;
                const inputType = detectInputType(newValue);
                
                // Prevent typing if mobile length is reached
                if (inputType === 'mobile') {
                    const mobileValue = restrictMobileInput(newValue);
                    // FIXED: Changed >= to > to allow exactly 10 digits
                    if (mobileValue.length > MOBILE_LENGTH && !(e.which == 8 || e.which == 46 || e.which == 37 || e.which == 39)) {
                        e.preventDefault();
                        return false;
                    }
                    
                    // Only allow digits for mobile
                    if (charCode < 48 || charCode > 57) {
                        e.preventDefault();
                        return false;
                    }
                }
                
                // Prevent typing if email length is reached
                if (inputType === 'email') {
                    // FIXED: Changed >= to > to allow exactly 60 characters
                    if (newValue.length > MAX_EMAIL_LENGTH && !(e.which == 8 || e.which == 46 || e.which == 37 || e.which == 39)) {
                        e.preventDefault();
                        return false;
                    }
                }
                
                return true;
            });
            
            // Handle identifier paste event
            identifierInput.on('paste', function(e) {
                setTimeout(() => {
                    let value = $(this).val();
                    const inputType = detectInputType(value);
                    
                    if (inputType === 'mobile') {
                        $(this).val(restrictMobileInput(value));
                    } else {
                        $(this).val(restrictEmailInput(value));
                    }
                    
                    validateIdentifier();
                    updateSubmitButton();
                }, 0);
            });
            
            passwordInput.on('input', function() {
                // Restrict password length
                if ($(this).val().length > MAX_PASSWORD_LENGTH) {
                    $(this).val($(this).val().slice(0, MAX_PASSWORD_LENGTH));
                }
                
                updateCharCounter($(this), passwordCounter, MAX_PASSWORD_LENGTH);
                validatePassword();
                updateSubmitButton();
            });
            
            // Show character counter on focus
            identifierInput.on('focus', function() {
                identifierCounter.show();
            });
            
            identifierInput.on('blur', function() {
                setTimeout(() => identifierCounter.hide(), 200);
                
                // Format mobile number with dashes on blur
                let value = $(this).val().trim();
                if (detectInputType(value) === 'mobile' && value.length === MOBILE_LENGTH) {
                    $(this).val(value.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3'));
                }
            });
            
            // Remove formatting on focus if it's mobile
            identifierInput.on('focus', function() {
                let value = $(this).val().trim();
                if (detectInputType(value) === 'mobile') {
                    $(this).val(restrictMobileInput(value));
                }
            });
            
            passwordInput.on('focus', function() {
                passwordCounter.show();
            });
            
            passwordInput.on('blur', function() {
                setTimeout(() => passwordCounter.hide(), 200);
            });
            
            // Toggle password visibility
            $('#togglePassword').click(function() {
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                
                // Toggle eye icon
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });
            
            // Update submit button state
            function updateSubmitButton() {
                const isIdentifierValid = validateIdentifier();
                const isPasswordValid = validatePassword();
                
                if (isIdentifierValid && isPasswordValid) {
                    submitBtn.prop('disabled', false);
                } else {
                    submitBtn.prop('disabled', true);
                }
            }
            
            // Form submission with additional validation
            loginForm.on('submit', function(e) {
                e.preventDefault();
                
                // Final validation
                const isIdentifierValid = validateIdentifier();
                const isPasswordValid = validatePassword();
                
                if (!isIdentifierValid || !isPasswordValid) {
                    showAlert('Please fix the validation errors before submitting', 'error');
                    return false;
                }
                
                // Sanitize inputs before submission
                let identifier = identifierInput.val().trim();
                const password = sanitizeInput(passwordInput.val());
                
                // Remove dashes from mobile number if present
                const inputType = detectInputType(identifier);
                if (inputType === 'mobile') {
                    identifier = restrictMobileInput(identifier);
                }
                
                // Set sanitized values back to form
                identifierInput.val(identifier);
                
                // Show loading state
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Authenticating...');
                submitBtn.prop('disabled', true);
                
                // Submit form after 100ms delay
                setTimeout(() => {
                    this.submit();
                }, 100);
                
                // Re-enable button after 10 seconds (in case of error)
                setTimeout(() => {
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                }, 10000);
                
                return true;
            });
            
            // Initialize validation and counters
            const initialValue = identifierInput.val().trim();
            const initialType = detectInputType(initialValue);
            
            if (initialType === 'mobile') {
                updateCharCounter(identifierInput, identifierCounter, MOBILE_LENGTH);
            } else {
                updateCharCounter(identifierInput, identifierCounter, MAX_EMAIL_LENGTH);
            }
            
            updateCharCounter(passwordInput, passwordCounter, MAX_PASSWORD_LENGTH);
            validateIdentifier();
            validatePassword();
            updateSubmitButton();
            
            // Alert function
            function showAlert(message, type = 'info') {
                // Remove existing alerts
                $('.custom-alert').remove();
                
                // Create alert element
                const alert = $(`
                    <div class="custom-alert" style="position: fixed; top: 20px; right: 20px; background: ${type === 'error' ? '#d32f2f' : '#4361ee'}; 
                        color: white; padding: 15px 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); 
                        display: flex; align-items: center; gap: 10px; z-index: 10000; animation: slideInRight 0.3s ease;">
                        <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `);
                
                $('body').append(alert);
                
                // Remove alert after 3 seconds
                setTimeout(() => {
                    alert.css('animation', 'slideOutRight 0.3s ease');
                    setTimeout(() => alert.remove(), 300);
                }, 3000);
            }
            
            // Add CSS for animations
            if (!$('#alert-styles').length) {
                $('head').append(`
                    <style id="alert-styles">
                        @keyframes slideInRight {
                            from { transform: translateX(100%); opacity: 0; }
                            to { transform: translateX(0); opacity: 1; }
                        }
                        @keyframes slideOutRight {
                            from { transform: translateX(0); opacity: 1; }
                            to { transform: translateX(100%); opacity: 0; }
                        }
                    </style>
                `);
            }
            });
    </script>
</body>
</html>
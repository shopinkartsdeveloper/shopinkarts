<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopInKarts - Forgot Password</title>
    
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

        /* Reset Password Card */
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

        /* Validation Message */
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
            display: block;
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
                    We'll send you a link to reset your password. Make sure to use the email or mobile number associated with your account.
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
                               autofocus
                               maxlength="60"
                               autocomplete="username">
                        <span class="char-counter" id="identifierCounter">0/60</span>
                        <span class="helper-text">Email (max 60 chars) or 10-digit mobile number only</span>
                    </div>
                    <div class="validation-message" id="identifierValidation"></div>
                    @error('identifier')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="buttons-container">
                    <button type="submit" class="submit-btn" id="submitBtn">
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
    $(document).ready(function() {
        const identifierInput = $('#identifier');
        const submitBtn = $('#submitBtn');
        const forgotForm = $('#forgotForm');
        const identifierIcon = $('#identifierIcon');
        const identifierValidation = $('#identifierValidation');
        const identifierCounter = $('#identifierCounter');
        
        // Character limits
        const MAX_EMAIL_LENGTH = 60;
        const MOBILE_LENGTH = 10;
        
        // XSS Prevention function
        function sanitizeInput(input) {
            return input.replace(/[<>"'&]/g, '');
        }
        
        // Email validation regex
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        // Mobile validation regex (only 10 digits)
        const mobileRegex = /^[0-9]{10}$/;
        
        // Mobile input restriction - only allow digits
        function restrictToDigits(input) {
            return input.replace(/\D/g, '');
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
        
        // Function to detect if input is email
        function isEmail(value) {
            // Remove any spaces
            value = value.trim();
            
            // If contains @, it's likely an email
            if (value.includes('@')) {
                return emailRegex.test(value);
            }
            
            return false;
        }
        
        // Function to detect if input is mobile (strict check)
        function isMobile(value) {
            // Remove any spaces and non-digit characters
            const digitsOnly = restrictToDigits(value);
            
            // For mobile, we check the original value too
            // If it's exactly 10 digits and contains no letters or @ symbol
            if (digitsOnly.length === MOBILE_LENGTH && 
                /^\d+$/.test(value.replace(/\s/g, '')) && // Only digits after removing spaces
                !value.includes('@')) {
                return true;
            }
            
            return false;
        }
        
        // Function to detect input type based on current value
        function detectInputType(value) {
            // If value contains @, it's definitely trying to be an email
            if (value.includes('@')) {
                return 'email';
            }
            
            // If value is exactly 10 digits and no letters, it's mobile
            const digitsOnly = restrictToDigits(value);
            if (digitsOnly.length === MOBILE_LENGTH && /^\d+$/.test(value.replace(/\s/g, ''))) {
                return 'mobile';
            }
            
            // If starts with letter and contains @ later, it's email
            if (/^[a-zA-Z]/.test(value) && value.includes('@')) {
                return 'email';
            }
            
            // If starts with digit and has exactly 10 digits, treat as mobile while typing
            if (/^\d/.test(value) && digitsOnly.length <= MOBILE_LENGTH) {
                return 'mobile';
            }
            
            // Default to email for everything else (gives benefit of doubt)
            return 'email';
        }
        
        // Function to validate identifier (email or mobile)
        function validateIdentifier() {
            let value = sanitizeInput(identifierInput.val().trim());
            
            if (!value) {
                identifierInput.addClass('error');
                identifierValidation.removeClass('valid').addClass('invalid').text('Email or mobile number is required');
                return false;
            }
            
            // First, detect what type of input this is
            const inputType = detectInputType(value);
            
            if (inputType === 'mobile') {
                const digitsOnly = restrictToDigits(value);
                
                if (digitsOnly.length === MOBILE_LENGTH) {
                    identifierIcon.removeClass('fa-envelope fa-user').addClass('fa-phone');
                    identifierInput.removeClass('error');
                    identifierValidation.removeClass('invalid').addClass('valid').text('✓ Valid mobile number');
                    return true;
                } else {
                    identifierInput.addClass('error');
                    identifierValidation.removeClass('valid').addClass('invalid').text(`Mobile number must be ${MOBILE_LENGTH} digits (${digitsOnly.length}/${MOBILE_LENGTH})`);
                    return false;
                }
            } else if (inputType === 'email') {
                // Check if it's a valid email format
                if (isEmail(value)) {
                    // Check email length
                    if (value.length > MAX_EMAIL_LENGTH) {
                        identifierInput.addClass('error');
                        identifierValidation.removeClass('valid').addClass('invalid').text(`Email is too long (max ${MAX_EMAIL_LENGTH} characters)`);
                        return false;
                    }
                    
                    identifierIcon.removeClass('fa-phone fa-user').addClass('fa-envelope');
                    identifierInput.removeClass('error');
                    identifierValidation.removeClass('invalid').addClass('valid').text('✓ Valid email format');
                    return true;
                } else {
                    // If it's not a valid email yet, check if user is in the middle of typing
                    if (value.includes('@')) {
                        // User has typed @ but email is incomplete
                        identifierIcon.removeClass('fa-phone fa-user').addClass('fa-envelope');
                        identifierInput.removeClass('error');
                        identifierValidation.removeClass('invalid valid');
                        return false;
                    } else {
                        // User might be typing email without @ yet
                        identifierIcon.removeClass('fa-phone fa-user').addClass('fa-envelope');
                        identifierInput.removeClass('error');
                        identifierValidation.removeClass('invalid').addClass('valid').text('✓ Continue typing your email');
                        return true;
                    }
                }
            }
            
            // If we can't determine the type
            identifierInput.addClass('error');
            identifierValidation.removeClass('valid').addClass('invalid').text('Please enter a valid email (max 60 chars) or 10-digit mobile number');
            return false;
        }
        
        // Handle identifier input with smart detection
        identifierInput.on('input', function() {
            let value = $(this).val();
            
            // Detect input type
            const inputType = detectInputType(value);
            
            if (inputType === 'mobile') {
                // For mobile, restrict to digits only
                const digitsOnly = restrictToDigits(value);
                $(this).val(digitsOnly.slice(0, MOBILE_LENGTH));
                updateCharCounter($(this), identifierCounter, MOBILE_LENGTH);
            } else {
                // For email, allow all characters but restrict length
                if (value.length > MAX_EMAIL_LENGTH) {
                    $(this).val(value.slice(0, MAX_EMAIL_LENGTH));
                }
                updateCharCounter($(this), identifierCounter, MAX_EMAIL_LENGTH);
            }
            
            validateIdentifier();
            updateSubmitButton();
        });
        
        // Handle identifier keypress to prevent unwanted behavior
        identifierInput.on('keypress', function(e) {
            const value = $(this).val();
            const inputType = detectInputType(value + String.fromCharCode(e.which));
            
            // If current input is being treated as mobile, only allow digits
            if (inputType === 'mobile') {
                const charCode = e.which ? e.which : e.keyCode;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                    return false;
                }
            }
            return true;
        });
        
        // Show character counter on focus
        identifierInput.on('focus', function() {
            identifierCounter.show();
        });
        
        identifierInput.on('blur', function() {
            setTimeout(() => identifierCounter.hide(), 200);
            
            // Auto-format mobile number on blur only if it's a mobile
            const value = $(this).val();
            if (isMobile(value)) {
                const digitsOnly = restrictToDigits(value);
                if (digitsOnly.length === MOBILE_LENGTH) {
                    $(this).val(digitsOnly.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3'));
                }
            }
        });
        
        // Remove formatting on focus if it's mobile
        identifierInput.on('focus', function() {
            const value = $(this).val();
            if (isMobile(value)) {
                const digitsOnly = restrictToDigits(value);
                if (digitsOnly.length === MOBILE_LENGTH) {
                    $(this).val(digitsOnly);
                }
            }
        });
        
        // Update submit button state
        function updateSubmitButton() {
            if (validateIdentifier()) {
                submitBtn.prop('disabled', false);
            } else {
                submitBtn.prop('disabled', true);
            }
        }
        
        // Form submission with additional validation
        forgotForm.on('submit', function(e) {
            e.preventDefault();
            
            // Final validation
            if (!validateIdentifier()) {
                showAlert('Please enter a valid email or mobile number', 'error');
                return false;
            }
            
            // Sanitize input before submission
            const identifier = sanitizeInput(identifierInput.val().trim());
            
            // Final type check before submission
            const inputType = detectInputType(identifier);
            
            if (inputType === 'mobile') {
                const digitsOnly = restrictToDigits(identifier);
                if (digitsOnly.length !== MOBILE_LENGTH) {
                    showAlert(`Mobile number must be exactly ${MOBILE_LENGTH} digits`, 'error');
                    identifierInput.focus();
                    return false;
                }
            } else if (inputType === 'email') {
                    if (!isEmail(identifier)) {
                        showAlert('Please enter a valid email address', 'error');
                        identifierInput.focus();
                        return false;
                    }
                    
                    if (identifier.length > MAX_EMAIL_LENGTH) {
                        showAlert(`Email must not exceed ${MAX_EMAIL_LENGTH} characters`, 'error');
                        identifierInput.focus();
                        return false;
                    }
                }
                
                identifierInput.val(identifier);
                
                // Show loading state
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Sending...');
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
            
            // Initial detection
            const initialType = detectInputType(initialValue);
            if (initialType === 'mobile') {
                updateCharCounter(identifierInput, identifierCounter, MOBILE_LENGTH);
            } else {
                updateCharCounter(identifierInput, identifierCounter, MAX_EMAIL_LENGTH);
            }
            
            validateIdentifier();
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
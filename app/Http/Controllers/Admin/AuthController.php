<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        
        return view('admin.auth.login');
    }

    /**
     * Handle login with email OR mobile
     */
    public function login(Request $request)
    {
        // XSS Protection - Clean input
        $cleanData = $this->cleanInput($request->all());
        
        $messages = [
            'identifier.required' => 'Please enter your email or mobile number',
            'identifier.max' => 'Email must not exceed 60 characters',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must not exceed 50 characters',
        ];

        $validator = Validator::make($cleanData, [
            'identifier' => [
                'required',
                'string',
                'max:60',
                function ($attribute, $value, $fail) {
                    // Prevent XSS in identifier
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the '.$attribute);
                    }
                    
                    // Check if it's email or mobile
                    $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                    $mobileDigits = preg_replace('/\D/', '', $value);
                    
                    if (!$isEmail && strlen($mobileDigits) !== 10) {
                        $fail('Please enter a valid email (max 60 chars) or 10-digit mobile number.');
                    }
                    
                    // If it's mobile, ensure it's exactly 10 digits
                    if (!$isEmail && strlen($mobileDigits) === 10 && !preg_match('/^[0-9]{10}$/', $mobileDigits)) {
                        $fail('Mobile number must contain exactly 10 digits.');
                    }
                    
                    // If it's email, check length
                    if ($isEmail && strlen($value) > 60) {
                        $fail('Email must not exceed 60 characters.');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
                function ($attribute, $value, $fail) {
                    // Prevent XSS in password
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the password');
                    }
                    
                    // Check password length
                    if (strlen($value) > 50) {
                        $fail('Password must not exceed 50 characters.');
                    }
                }
            ],
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Validation failed');
        }

        $identifier = $cleanData['identifier'];
        $password = $cleanData['password'];
        
        // Additional XSS check
        if ($this->containsXSS($identifier) || $this->containsXSS($password)) {
            return back()->withErrors([
                'identifier' => 'Invalid characters detected.',
            ])->withInput()->with('error', 'Security validation failed');
        }
        
        // First, find the user
        $user = $this->findUserByIdentifier($identifier);
        
        // Check if user exists
        if (!$user) {
            return back()->withErrors([
                'identifier' => 'The provided credentials do not match our records.',
            ])->withInput()->with('error', 'Invalid credentials');
        }
        
        // Check if user is soft deleted
        if ($user->trashed()) {
            return back()->withErrors([
                'identifier' => 'Your account has been deleted. Please contact administrator.',
            ])->withInput()->with('error', 'Account deleted');
        }
        
        // Check if user is active
        if ($user->status !== 'active') {
            $statusMessage = $user->status === 'inactive' ? 'inactive' : 'pending approval';
            return back()->withErrors([
                'identifier' => 'Your account is '.$statusMessage.'. Please contact administrator.',
            ])->withInput()->with('error', 'Account '.$user->status);
        }
        
        // Now attempt authentication
        $authenticatedUser = $this->authenticateUser($identifier, $password, $request->remember);
        
        if ($authenticatedUser) {
            Auth::login($authenticatedUser, $request->remember);
            $request->session()->regenerate();
            
            return $this->redirectToDashboard()
                ->with('success', 'Login successful! Welcome back.');
        }

        return back()->withErrors([
            'identifier' => 'The provided credentials do not match our records.',
        ])->withInput()->with('error', 'Invalid credentials');
    }

    /**
     * Find user by email or mobile identifier
     */
    private function findUserByIdentifier($identifier)
    {
        $field = $this->getIdentifierType($identifier);
        
        if ($field === 'email') {
            return User::where('email', $identifier)->withTrashed()->first();
        } else {
            $mobile = $this->cleanMobileNumber($identifier);
            return User::where('mobile', $mobile)
                     ->orWhere('mobile_number', $mobile)
                     ->withTrashed()
                     ->first();
        }
    }

    /**
     * Clean input data to prevent XSS
     */
    private function cleanInput($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                // Remove HTML tags and encode special characters
                $data[$key] = htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
            }
        }
        return $data;
    }

    /**
     * Check if string contains XSS patterns
     */
    private function containsXSS($string)
    {
        $xss_patterns = [
            '/<script/i',
            '/javascript:/i',
            '/on\w+\s*=/i',
            '/data:/i',
            '/vbscript:/i',
            '/expression\s*\(/i',
            '/url\s*\(/i',
        ];

        foreach ($xss_patterns as $pattern) {
            if (preg_match($pattern, $string)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Authenticate user by email or mobile
     */
    private function authenticateUser($identifier, $password, $remember = false)
    {
        $field = $this->getIdentifierType($identifier);
        
        if ($field === 'email') {
            $credentials = ['email' => $identifier, 'password' => $password];
            if (Auth::validate($credentials)) {
                return User::where('email', $identifier)->first();
            }
        } else {
            $mobile = $this->cleanMobileNumber($identifier);
            
            // Try with mobile field
            $credentials = ['mobile' => $mobile, 'password' => $password];
            if (Auth::validate($credentials)) {
                return User::where('mobile', $mobile)->first();
            }
            
            // Try with mobile_number field
            $credentials = ['mobile_number' => $mobile, 'password' => $password];
            if (Auth::validate($credentials)) {
                return User::where('mobile_number', $mobile)->first();
            }
            
            // Manual check
            $user = User::where('mobile', 'like', '%' . $mobile . '%')
                       ->orWhere('mobile_number', 'like', '%' . $mobile . '%')
                       ->first();
            if ($user && Hash::check($password, $user->password)) {
                return $user;
            }
        }
        
        // Try with custom scope
        $user = User::where(function($query) use ($identifier) {
            $query->where('email', $identifier)
                  ->orWhere('mobile', 'like', '%' . $this->cleanMobileNumber($identifier) . '%')
                  ->orWhere('mobile_number', 'like', '%' . $this->cleanMobileNumber($identifier) . '%');
        })->first();
        
        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        
        return null;
    }

    /**
     * Determine if identifier is email or mobile
     */
    private function getIdentifierType($identifier)
    {
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }
        
        $mobile = preg_replace('/\D/', '', $identifier);
        if (strlen($mobile) === 10 && is_numeric($mobile)) {
            return 'mobile';
        }
        
        return 'email';
    }

    /**
     * Clean mobile number
     */
    private function cleanMobileNumber($mobile)
    {
        return preg_replace('/\D/', '', $mobile);
    }

    /**
     * Redirect to appropriate dashboard based on user role
     */
    private function redirectToDashboard()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->hasRole('seller')) {
            return redirect()->route('seller.dashboard');
        }
        
        if ($user->hasRole('manufacturer')) {
            return redirect()->route('manufacturer.dashboard');
        }
        
        if ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }
        
        return redirect('/home');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show registration form for all user types
     */
    public function showRegister($type = 'customer')
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        
        $allowedTypes = ['seller', 'manufacturer', 'customer'];
        
        if (request()->is('admin/*')) {
            $allowedTypes[] = 'admin';
        }
        
        if (!in_array($type, $allowedTypes)) {
            abort(404, 'Registration type not found.');
        }
        
        return view('admin.auth.register', compact('type'));
    }

    /**
     * Handle registration for all user types
     */
    public function register(Request $request)
    {
        $type = $request->type ?? 'customer';
        
        $mobile = preg_replace('/\D/', '', $request->mobile);
        
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the name');
                    }
                }
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:60', // Changed from 255 to 60
                'unique:users',
                function ($attribute, $value, $fail) {
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the email');
                    }
                    if (strlen($value) > 60) {
                        $fail('Email must not exceed 60 characters.');
                    }
                }
            ],
            'mobile' => [
                'required',
                'string',
                'max:15',
                'unique:users',
                'regex:/^[0-9]{10}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50', // Changed from 255 to 50
                'confirmed',
                function ($attribute, $value, $fail) {
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the password');
                    }
                    if (!preg_match('/[A-Za-z]/', $value) || !preg_match('/[0-9]/', $value)) {
                        $fail('Password must contain both letters and numbers');
                    }
                    if (strlen($value) > 50) {
                        $fail('Password must not exceed 50 characters.');
                    }
                }
            ],
            'type' => 'required|in:admin,seller,manufacturer,customer',
        ];
        
        if ($type === 'admin' && !$request->is('admin/*')) {
            abort(403, 'Admin registration not allowed from this route.');
        }
        
        $validator = Validator::make(array_merge($request->all(), ['mobile' => $mobile]), $rules, [
            'mobile.regex' => 'Please enter a valid 10-digit mobile number',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Registration validation failed');
        }
        
        // Additional XSS check
        if ($this->containsXSS($request->name) || $this->containsXSS($request->email)) {
            return back()->withErrors(['general' => 'Invalid characters detected.'])->withInput();
        }
        
        $user = User::create([
            'name' => htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8'),
            'email' => $request->email,
            'mobile' => $mobile,
            'mobile_number' => $mobile, // Also set mobile_number field
            'password' => Hash::make($request->password),
            'type' => $type,
            'status' => 'active', // New registrations are active by default
            'email_verified_at' => now(),
        ]);
        
        $user->assignRole($type);
        
        Auth::login($user);
        
        return $this->redirectToDashboard()
            ->with('success', 'Registration successful! Welcome to Shopinkarts.');
    }
    
    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        
        return view('admin.auth.forgot-password');
    }
    
    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request)
    {
        // Clean input
        $cleanData = $this->cleanInput($request->all());
        
        $validator = Validator::make($cleanData, [
            'identifier' => [
                'required',
                'string',
                'max:60',
                function ($attribute, $value, $fail) {
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected');
                    }
                    
                    // Check if it's email or mobile
                    $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                    $mobileDigits = preg_replace('/\D/', '', $value);
                    
                    if (!$isEmail && strlen($mobileDigits) !== 10) {
                        $fail('Please enter a valid email (max 60 chars) or 10-digit mobile number.');
                    }
                    
                    // If it's email, check length
                    if ($isEmail && strlen($value) > 60) {
                        $fail('Email must not exceed 60 characters.');
                    }
                }
            ],
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $identifier = $cleanData['identifier'];
        
        $user = $this->findUserByIdentifier($identifier);
        
        if (!$user) {
            return back()->withErrors([
                'identifier' => 'No account found with this email or mobile number.',
            ])->withInput();
        }
        
        // Check if user is deleted
        if ($user->trashed()) {
            return back()->withErrors([
                'identifier' => 'Your account has been deleted. Please contact administrator.',
            ])->withInput();
        }
        
        // Check if user is active
        if ($user->status !== 'active') {
            $statusMessage = $user->status === 'inactive' ? 'inactive' : 'pending approval';
            return back()->withErrors([
                'identifier' => 'Your account is '.$statusMessage.'. Please contact administrator.',
            ])->withInput();
        }
        
        $token = Str::random(60);
        
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );
        
        $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);
        
        return redirect()->route('password.reset', ['token' => $token])
            ->with('success', 'Password reset link has been sent to your email.')
            ->with('reset_link', $resetLink);
    }
    
    /**
     * Show reset password form
     */
    public function showResetForm(Request $request, $token = null)
    {
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }
        
        $email = htmlspecialchars($request->email, ENT_QUOTES, 'UTF-8');
        
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }
    
    /**
     * Reset password
     */
    public function reset(Request $request)
    {
        // Clean input
        $cleanData = $this->cleanInput($request->all());
        
        $validator = Validator::make($cleanData, [
            'token' => 'required',
            'email' => [
                'required',
                'email',
                'max:60', // Changed from 255 to 60
                function ($attribute, $value, $fail) {
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the email');
                    }
                    if (strlen($value) > 60) {
                        $fail('Email must not exceed 60 characters.');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50', // Changed from 255 to 50
                'confirmed',
                function ($attribute, $value, $fail) {
                    if ($this->containsXSS($value)) {
                        $fail('Invalid characters detected in the password');
                    }
                    if (!preg_match('/[A-Za-z]/', $value) || !preg_match('/[0-9]/', $value)) {
                        $fail('Password must contain both letters and numbers');
                    }
                    if (strlen($value) > 50) {
                        $fail('Password must not exceed 50 characters.');
                    }
                }
            ],
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $tokenData = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();
        
        if (!$tokenData) {
            return back()->withErrors(['email' => 'Invalid reset token.'])->withInput();
        }
        
        if (now()->diffInHours($tokenData->created_at) > 24) {
            \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Reset token has expired.'])->withInput();
        }
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'User not found.'])->withInput();
        }
        
        // Check if user is deleted
        if ($user->trashed()) {
            return back()->withErrors(['email' => 'Your account has been deleted. Please contact administrator.'])->withInput();
        }
        
        // Check if user is active
        if ($user->status !== 'active') {
            $statusMessage = $user->status === 'inactive' ? 'inactive' : 'pending approval';
            return back()->withErrors(['email' => 'Your account is '.$statusMessage.'. Please contact administrator.'])->withInput();
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        Auth::login($user);
        
        return $this->redirectToDashboard()
            ->with('success', 'Your password has been reset successfully!');
    }
    
    /**
     * Find user by email or mobile using custom scope
     */
    private function findUserByEmailOrMobile($identifier)
    {
        $field = $this->getIdentifierType($identifier);
        
        if ($field === 'email') {
            return User::where('email', $identifier)->withTrashed()->first();
        } else {
            $mobile = $this->cleanMobileNumber($identifier);
            return User::where('mobile', $mobile)
                     ->orWhere('mobile_number', $mobile)
                     ->withTrashed()
                     ->first();
        }
    }
}
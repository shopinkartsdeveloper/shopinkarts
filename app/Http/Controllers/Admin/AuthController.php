<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $messages = [
            'identifier.required' => 'Please enter your email or mobile number',
            'password.required' => 'Please enter your password',
        ];

        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'password' => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $identifier = $request->identifier;
        $password = $request->password;
        
        $user = $this->authenticateUser($identifier, $password, $request->remember);
        
        if ($user) {
            Auth::login($user, $request->remember);
            $request->session()->regenerate();
            
            return $this->redirectToDashboard()
                ->with('success', 'Login successful! Welcome back.');
        }

        return back()->withErrors([
            'identifier' => 'The provided credentials do not match our records.',
        ])->withInput();
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
            
            $credentials = ['mobile' => $mobile, 'password' => $password];
            if (Auth::validate($credentials)) {
                return User::where('mobile', $mobile)->first();
            }
            
            $user = User::where('mobile', 'like', '%' . $mobile . '%')->first();
            if ($user && Hash::check($password, $user->password)) {
                return $user;
            }
        }
        
        $user = User::findByEmailOrMobile($identifier)->first();
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
        if (strlen($mobile) >= 10 && is_numeric($mobile)) {
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => [
                'required',
                'string',
                'max:15',
                'unique:users',
                'regex:/^[0-9]{10}$/',
            ],
            'password' => 'required|string|min:8|confirmed',
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
            return back()->withErrors($validator)->withInput();
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $mobile,
            'password' => Hash::make($request->password),
            'type' => $type,
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
        $request->validate([
            'identifier' => 'required|string',
        ]);
        
        $identifier = $request->identifier;
        
        $user = User::findByEmailOrMobile($identifier)->first();
        
        if (!$user) {
            $mobile = $this->cleanMobileNumber($identifier);
            if (strlen($mobile) >= 10) {
                $user = User::where('mobile', $mobile)->first();
            }
        }
        
        if (!$user) {
            return back()->withErrors([
                'identifier' => 'No account found with this email or mobile number.',
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
        
        $email = $request->email;
        
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
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
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
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        Auth::login($user);
        
        return $this->redirectToDashboard()
            ->with('success', 'Your password has been reset successfully!');
    }
}
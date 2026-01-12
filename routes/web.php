<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Manufacturer\ManufacturerDashboardController;
use App\Http\Controllers\Customer\CustomerDashboardController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Register Routes
    Route::get('/register/{type}', [AuthController::class, 'showRegister'])
        ->where('type', 'seller|manufacturer|customer')
        ->name('register');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
        ->name('password.request');
    
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->name('password.email');
    
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('password.reset');
    
    Route::post('/reset-password', [AuthController::class, 'reset'])
        ->name('password.update');
});

// Admin Routes Group
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(DashboardController::class)->index();
    })->name('dashboard');
    
    // Admin Registration
    Route::get('/register/admin', function () {
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(AuthController::class)->showRegister('admin');
    })->name('register.admin');
    
    // Sellers Routes
    Route::prefix('sellers')->name('sellers.')->group(function () {
        Route::get('/', function () {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->index();
        })->name('index');
        
        Route::get('/create', function () {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->create();
        })->name('create');
        
        Route::post('/', function (Request $request) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->store($request);
        })->name('store');
        
        Route::get('/{id}', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->show($id);
        })->name('show');
        
        Route::get('/{id}/edit', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->edit($id);
        })->name('edit');
        
        Route::put('/{id}', function (Request $request, $id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->update($request, $id);
        })->name('update');
        
        Route::delete('/{id}', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->destroy($id);
        })->name('destroy');
        
        Route::patch('/{id}/restore', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->restore($id);
        })->name('restore');
        
        Route::delete('/{id}/force-delete', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->forceDelete($id);
        })->name('force-delete');
    });

    // Manufacturers Routes
    Route::prefix('manufacturers')->name('manufacturers.')->group(function () {
        Route::get('/', function () {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->index();
        })->name('index');
        
        Route::get('/create', function () {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->create();
        })->name('create');
        
        Route::post('/', function (Request $request) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->store($request);
        })->name('store');
        
        Route::get('/{id}', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->show($id);
        })->name('show');
        
        Route::get('/{id}/edit', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->edit($id);
        })->name('edit');
        
        Route::put('/{id}', function (Request $request, $id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->update($request, $id);
        })->name('update');
        
        Route::delete('/{id}', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->destroy($id);
        })->name('destroy');
        
        Route::patch('/{id}/restore', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->restore($id);
        })->name('restore');
        
        Route::delete('/{id}/force-delete', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->forceDelete($id);
        })->name('force-delete');
    });
    
    // Categories Resource
    Route::resource('categories', CategoryController::class);
    
    // Products Resource
    Route::resource('products', ProductController::class);
    
    // Simple Trash Route - NO NESTED GROUPS
    Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
    
    // Restore routes
    Route::patch('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');
});

// Seller Routes
Route::middleware(['auth'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('seller')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(SellerDashboardController::class)->index();
    })->name('dashboard');
});

// Manufacturer Routes
Route::middleware(['auth'])->prefix('manufacturer')->name('manufacturer.')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('manufacturer')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(ManufacturerDashboardController::class)->index();
    })->name('dashboard');
});

// Customer Routes
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('customer')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(CustomerDashboardController::class)->index();
    })->name('dashboard');
});

// Common Routes
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Home redirect
    Route::get('/home', function () {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('seller')) {
            return redirect()->route('seller.dashboard');
        } elseif ($user->hasRole('manufacturer')) {
            return redirect()->route('manufacturer.dashboard');
        } elseif ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }
        
        return redirect('/');
    })->name('home');
});
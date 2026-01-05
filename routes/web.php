<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Manufacturer\ManufacturerDashboardController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Public)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register/{type}', [AuthController::class, 'showRegister'])
        ->where('type', 'seller|manufacturer|customer')
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(DashboardController::class)->index();
    })->name('dashboard');

    Route::prefix('sellers')->name('sellers.')->group(function () {
        Route::get('/', function () {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->index();
        })->name('index');

        Route::get('/{id}', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(SellerController::class)->show($id);
        })->name('show');
    });

    Route::prefix('manufacturers')->name('manufacturers.')->group(function () {
        Route::get('/', function () {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->index();
        })->name('index');

        Route::get('/{id}', function ($id) {
            if (!Auth::user()->hasRole('admin')) {
                return redirect('/home')->with('error', 'Access denied.');
            }
            return app(ManufacturerController::class)->show($id);
        })->name('show');
    });

    Route::get('/register/admin', function () {
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(AuthController::class)->showRegister('admin');
    })->name('register.admin');

    /*
    |--------------------------------------------------------------------------
    | ✅ NEW: Categories (Admin Only)
    |--------------------------------------------------------------------------
    */
    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | ✅ NEW: Products (Admin Only)
    |--------------------------------------------------------------------------
    */
    Route::resource('products', ProductController::class);
});

/*
|--------------------------------------------------------------------------
| Seller Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('seller')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(SellerDashboardController::class)->index();
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Manufacturer Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('manufacturer')->name('manufacturer.')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('manufacturer')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(ManufacturerDashboardController::class)->index();
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Customer Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () {
        if (!Auth::user()->hasRole('customer')) {
            return redirect('/home')->with('error', 'Access denied.');
        }
        return app(CustomerDashboardController::class)->index();
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Common Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

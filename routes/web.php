<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Customer\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home / Landing Page
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'driver' => redirect()->route('driver.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => redirect()->route('login'),
        };
    }
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// ADMIN ROUTES
// ==========================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Car Management (CRUD)
    Route::resource('cars', CarController::class);
    
    // Tracking
    Route::get('/tracking', [AdminController::class, 'tracking'])->name('tracking');
    
    // Sales/Revenue
    Route::get('/sales', [AdminController::class, 'sales'])->name('sales');
    
    // Order History
    Route::get('/orders', [AdminController::class, 'orderHistory'])->name('orders.index');
    Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('orders.show');
});

// ==========================================
// DRIVER ROUTES
// ==========================================
Route::prefix('driver')->name('driver.')->middleware(['auth', 'role:driver'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
    
    // Order Management
    Route::post('/orders/{id}/confirm', [DriverController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('/orders/{id}/reject', [DriverController::class, 'rejectOrder'])->name('orders.reject');
    Route::get('/orders/{id}', [DriverController::class, 'showOrder'])->name('orders.show');
});

// ==========================================
// CUSTOMER ROUTES
// ==========================================
Route::prefix('customer')->name('customer.')->middleware(['auth', 'role:customer'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    
    // Browse Cars
    Route::get('/cars', [CustomerController::class, 'browseCars'])->name('cars');
    Route::get('/cars/{id}', [CustomerController::class, 'showCar'])->name('cars.show');
    
    // Booking
    Route::get('/cars/{id}/book', [CustomerController::class, 'bookingForm'])->name('booking.form');
    Route::post('/cars/{id}/book', [CustomerController::class, 'storeBooking'])->name('booking.store');
    
    // Payment
    Route::get('/orders/{id}/payment', [CustomerController::class, 'payment'])->name('payment');
    Route::post('/orders/{id}/payment', [CustomerController::class, 'processPayment'])->name('payment.process');
    
    // Orders
    Route::get('/orders/{id}', [CustomerController::class, 'showOrder'])->name('orders.show');
    Route::get('/order-history', [CustomerController::class, 'orderHistory'])->name('orders.history');
    Route::post('/orders/{id}/cancel', [CustomerController::class, 'cancelOrder'])->name('orders.cancel');
});
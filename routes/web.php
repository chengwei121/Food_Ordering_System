<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;

// Admin Authentication Routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Redirect admin root to dishes index
    Route::get('/', function () {
        return redirect()->route('admin.dishes.index');
    });

    // Dashboard
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Management
    Route::resource('admins', AdminController::class);

    // Dish Management
    Route::controller(DishController::class)->group(function () {
        Route::get('/dishes', 'index')->name('dishes.index');
        Route::get('/dishes/create', 'create')->name('dishes.create');
        Route::post('/dishes', 'store')->name('dishes.store');
        Route::get('/dishes/{dish}/edit', 'edit')->name('dishes.edit');
        Route::put('/dishes/{dish}', 'update')->name('dishes.update');
        Route::delete('/dishes/{dish}', 'destroy')->name('dishes.destroy');
        Route::patch('/dishes/{dish}/toggle-availability', 'toggleAvailability')->name('dishes.toggle-availability');
    });

    // Order Management
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders.index');
        Route::get('/orders/{order}', 'show')->name('orders.show');
        Route::patch('/orders/{order}/status', 'updateStatus')->name('orders.update-status');
        // Add kitchen display system routes
        Route::get('/kitchen', 'kitchen')->name('kitchen');
        Route::get('/orders/by-status/{status}', 'getOrdersByStatus')->name('orders.by-status');
    });
});

// Redirect root to admin login if not authenticated
Route::get('/', function () {
    return redirect()->route('admin.login');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShippingAddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'welcome'])->name('welcome');

Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/auth/signup', [AuthController::class, 'showSignupForm'])->name('auth.signup');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    Route::prefix('customers')->group(function() {
        Route::get('/{id}/billing-address/create', [BillingAddressController::class, 'create'])->name('customers.addresses.billing.create');
        Route::post('/{id}/billing-address', [BillingAddressController::class, 'store'])->name('customers.addresses.billing.store');
        Route::get('/{id}/shipping-address/create', [ShippingAddressController::class, 'create'])->name('customers.addresses.shipping.create');
        Route::post('/{id}/shipping-address', [ShippingAddressController::class, 'store'])->name('customers.addresses.shipping.store');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('customer.show');
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    });
});

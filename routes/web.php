<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\CustomerContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\TicketController;
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
        Route::get('/{id}/billing-address/{address_id}/edit', [BillingAddressController::class, 'edit'])->name('customers.addresses.billing.edit');
        Route::put('/{id}/billing-address/{address_id}', [BillingAddressController::class, 'update'])->name('customers.addresses.billing.update');
        Route::get('/{id}/billing-address/create', [BillingAddressController::class, 'create'])->name('customers.addresses.billing.create');
        Route::post('/{id}/billing-address', [BillingAddressController::class, 'store'])->name('customers.addresses.billing.store');
        Route::get('/{id}/shipping-address/{address_id}/edit', [ShippingAddressController::class, 'edit'])->name('customers.addresses.shipping.edit');
        Route::put('/{id}/shipping-address/{address_id}', [ShippingAddressController::class, 'update'])->name('customers.addresses.shipping.update');
        Route::get('/{id}/shipping-address/create', [ShippingAddressController::class, 'create'])->name('customers.addresses.shipping.create');
        Route::post('/{id}/shipping-address', [ShippingAddressController::class, 'store'])->name('customers.addresses.shipping.store');
        Route::get('/{id}/contacts/create', [CustomerContactController::class, 'create'])->name('customers.contacts.create');
        Route::post('/{id}/contacts', [CustomerContactController::class, 'store'])->name('customers.contacts.store');
        Route::get('/{id}/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
        Route::post('/{id}/ticket', [TicketController::class, 'store'])->name('ticket.store');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('customer.show');
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    });

    Route::prefix('tickets')->group(function() {
        Route::get('/{id}', [TicketController::class, 'show'])->name('ticket.show');
    });
});

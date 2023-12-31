<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\Admin\PaymentPlanController;
use App\Http\Controllers\Admin\PaymentPlanFeatureController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/retailer/dashboard', [RetailerController::class, 'dashboard'])->name('retailer.dashboard');
Route::get('customer/create', [RetailerController::class, 'customers'])->name('customer.create');
Route::get('/walk-in-customer/create', [RetailerController::class, 'walk_in'])->name('walkin.create');
Route::get('/item/create', [RetailerController::class, 'items'])->name('item.create');

// Customers Routes
Route::get('customers', [CustomerController::class,'index']);
// Route::get('customer/create', [CustomerController::class,'create']);
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::post('/search-customer', [CustomerController::class, 'searchCustomer'])->name('search.customer');
// Team Members Routes
Route::get('/team-members', [TeamMemberController::class, 'index'])->name('team-members.index');
Route::get('/team-members/create', [TeamMemberController::class, 'create'])->name('team-members.create');
Route::post('/team-members', [TeamMemberController::class, 'store'])->name('team-members.store');
Route::get('/team-members/{teamMember}', [TeamMemberController::class, 'show'])->name('team-members.show');
Route::get('/team-members/{teamMember}/edit', [TeamMemberController::class, 'edit'])->name('team-members.edit');
Route::put('/team-members/{teamMember}', [TeamMemberController::class, 'update'])->name('team-members.update');
Route::delete('/team-members/{teamMember}', [TeamMemberController::class, 'destroy'])->name('team-members.destroy');

// Order/Serive Details
Route::get('/service-details', [ServiceDetailController::class, 'index'])->name('service_detail.index');
Route::get('/service-detail/create', [ServiceDetailController::class, 'create'])->name('service_detail.create');
Route::post('/service-details', [ServiceDetailController::class, 'store'])->name('service_detail.store');
Route::get('/service-details/{service-detail}', [ServiceDetailController::class, 'show'])->name('service_detail.show');
Route::get('/service-details/{service-detail}/edit', [ServiceDetailController::class, 'edit'])->name('service_detail.edit');
Route::put('/service-details/{service-detail}', [ServiceDetailController::class, 'update'])->name('service_detail.update');
Route::delete('/service-details/{service-detail}', [ServiceDetailController::class, 'destroy'])->name('service_detail.destroy');
// Ticket Routes
Route::put('/tickets/{id}/update-status', [TicketController::class, 'updateTicketStatus'])->name('tickets.updateStatus');

// Item Routes
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
// Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
// Admin Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Pyament Plan routes
Route::get('/payment-plans', [PaymentPlanController::class, 'index'])->name('paymentPlans');
Route::post('/payment-plans', [PaymentPlanController::class, 'store']);
Route::get('/payment-plans/{payment_plan}/edit', [PaymentPlanController::class, 'edit']);
Route::put('/payment-plans/{payment_plan}', [PaymentPlanController::class, 'update']);
Route::delete('/payment-plans/{payment_plan}', [PaymentPlanController::class, 'destroy']); 

// Payment Plan Features routes
Route::get('/payment-plans/{payment_plan:slug?}/features', [PaymentPlanFeatureController::class, 'index'])->name('paymentPlanFeatures');
Route::post('/payment-plan-feature/create', [PaymentPlanFeatureController::class, 'store']);
// Route::get('/payment-plans/{payment_plan:slug}/features/{feature:slug}', [PaymentPlanFeatureController::class, 'show']);
Route::get('/payment-plan-feature/{feature}/edit', [PaymentPlanFeatureController::class, 'edit']);
Route::put('/payment-plan-feature/{feature}', [PaymentPlanFeatureController::class, 'update']);
Route::delete('/payment-plan-feature/{feature}', [PaymentPlanFeatureController::class, 'destroy']);
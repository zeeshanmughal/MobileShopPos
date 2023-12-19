<?php


use App\Models\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\TeamMemberController;
use Twilio\Rest\Events\V1\SubscriptionContext;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PaymentPlanController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\PaymentPlanFeatureController;
use App\Http\Controllers\Auth\VerificationController as AuthVerificationController;

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

// Route::get('/', function () {
//     return redirect('login');
// });

Route::get('/create-storage-link', function () {
    try {
        // Run the storage:link command
        Artisan::call('storage:link');

        // Output a success message
        return 'Symbolic link for storage created successfully!';
    } catch (\Exception $e) {
        // Output an error message
        return 'Error creating symbolic link: ' . $e->getMessage();
    }
});

Route::get('/artisan/{command}', function ($command) {
    Artisan::call($command);
    return Artisan::output();
})->where('command', '.*');

Route::middleware(['web'])->group(function () {
    Auth::routes();

  

    Route::match(['get', 'post'], '/account/verify/{token}', [AuthVerificationController::class, 'verifyAccount'])->name('user.verify');
    Route::post('/email/resend',[AuthVerificationController::class,'resend_verification_email'])->name('resendVerificationEmail');
    Route::get('/qrcode', [CustomerController::class, 'generateQRCode'])->name('qrcode.generate');
    Route::get('/walk-in-customer', [CustomerController::class, 'getWalkinCustomerForm'])->name('walkInByCustomer.create');
    Route::post('/walk-in-customer/service-details/store', [CustomerController::class, 'walkInServiceDetailStore'])->name('walkInServiceDetail.store');
    Route::get('/search-device-issues', [CustomerController::class, 'searchDeviceIssues'])->name('device_issue.search');
    Route::post('/device-issue/add', [CustomerController::class, 'addNewIssue'])->name('issue.store');
    Route::get('walkin-customer/ticket/{customer_id}', [CustomerController::class, 'getTicketView'])->name('getWalkinCustomerTicketView');
    Route::redirect('/', '/login');
});


// Route::post('post-registration', [RegisterController::class, 'postRegistration'])->name('register.post');


Route::group(['middleware' => ['retailer.auth','is_verify_email']], function () {

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/retailer/dashboard', [RetailerController::class, 'dashboard'])->name('retailer.dashboard');
    Route::get('/customer/create', [RetailerController::class, 'customers'])->name('customer.create');
    Route::get('/customer/search', [RetailerController::class, 'customers'])->name('customer.search');
    
    Route::get('/walk-in-customer/create', [RetailerController::class, 'walkInByRetailer'])->name('walkInByRetailer.create');
    Route::post('/walk-in-customer/service-details', [RetailerController::class, 'serviceDetailStore'])->name('service-detail.store');



    // Customers Routes

    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');

    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [CustomerController::class, 'edit'])->name('customers.edit');

    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/search-customer', [CustomerController::class, 'searchCustomer'])->name('search.customer');
    Route::get('/get-customers', [CustomerController::class, 'getDropdownCustomers'])->name('get.dropdown.customers');

    Route::get('/fetch-customer', [CustomerController::class, 'fetchCustomerData'])->name('fetchCustomerData');

    // Ticket Routes
    Route::post('/tickets/update-status', [TicketController::class, 'updateTicketStatus'])->name('tickets.updateStatus');
    Route::get('/tickets', [TicketController::class, 'tickets'])->name('ticket.index');
    Route::get('/search-tickets/{status?}', [TicketController::class, 'searchTickets'])->name('search-tickets');
    Route::get('/tickets/print-ticket/{ticketId}', [TicketController::class, 'printTicket'])->name('ticket.print');
    Route::get('/print-label', [TicketController::class, 'printLable'])->name('label.print');


    // Phone Buy and Sell
    Route::get('/phone-buy', [PhoneController::class, 'createPhoneBuy'])->name('phone_buy.create');
    Route::post('/phone-buy', [PhoneController::class, 'storePhoneBuy'])->name('phone_buy.store');
    Route::get('/phone-list', [PhoneController::class, 'phoneList'])->name('retailer.phones');
    Route::post('/update-phone-trail', [PhoneController::class, 'updatePhoneTrail'])->name('updatePhoneTrail');
    Route::match(['get', 'post'], '/search-phone', [PhoneController::class, 'searchPhones'])->name('phone.search');

    Route::post('/sell-phone', [PhoneController::class, 'sellPhoneStore'])->name('phone_sell.store');


    Route::get('/device-issues', [CustomerController::class, 'getDeviceIssues'])->name('device_issues');
    Route::post('/device-issue', [CustomerController::class, 'storeOrUpdate'])->name('issueStoreOrUpdate');
    Route::delete('/device-issue/{issue}', [CustomerController::class, 'destroy_issue'])->name('issue.destory');


    Route::resource('/categories', CategoryController::class)->except(['show']);

    Route::get('/subscribe', [SubscriptionController::class, 'showSubscriptionForm'])->name('user.showSubscribeForm');
    Route::post('/direct-debit-setup', [SubscriptionController::class, 'handleDirectDebitSetup'])->name('direct.debit.setup');
    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

    Route::get('/subscribe/plans', [SubscriptionController::class, 'showSubscriptionPlans'])->name('subscriptionPlans.show');
    Route::post('/subscribe/{planId}', [SubscriptionController::class, 'subscribe'])->name('user.subscribe');

    Route::get('/profile', [RetailerController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [RetailerController::class, 'updateProfile'])->name('profile.update');
});

Route::get('sms/send', [CustomerController::class, 'sendSms']);

Route::get('/send-email', [EmailController::class, 'sendEmail']);

// Route::get('customer/create', [CustomerController::class,'create']);


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

// Item Routes
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
Route::post('/item', [ItemController::class, 'store'])->name('item.store');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');
Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
Route::put('/item/{item}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');


// Group routes for admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::post('/logout', [AdminAuthController::class, 'adminLogout'])->name('admin.logout');
});

// Admin Routes
Route::group(['middleware' => 'admin.auth'], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Route to display all users
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    // Route to make a user active
    Route::post('/admin/user/make-active/{id}', [AdminController::class, 'makeUserActive'])->name('admin.user.makeActive');

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
});

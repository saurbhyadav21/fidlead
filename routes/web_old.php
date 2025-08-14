<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BuyerSellerDataController;
use App\Http\Controllers\PackageController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use App\Models\PointHistory;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\PurchasedLead;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\MarqueeController;

use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;

use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketResponseController;
use App\Http\Controllers\AdminTicketController;
// use DB;

Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin/dashboard');

    //Create USer
    Route::resource('customers', CustomerController::class);
    Route::post('/customers/{customer}/addPointss', [CustomerController::class, 'addPointss'])->name('customers.addPointss');

    Route::get('/upload', function () {
        return view('admin.upload');
    })->name('upload');

    Route::post('/upload', [BuyerSellerDataController::class, 'upload']);
    
    //All Buyer Data to Edit
    Route::get('/BuyerDataShow', function () {
        return view('admin.BuyerDataShow');
    })->name('BuyerDataShow');
    Route::get('buyerseller/data', [BuyerSellerDataController::class, 'getBuyerSellerData'])->name('buyerseller.data');
    Route::get('buyerseller/{id}/edit', [BuyerSellerDataController::class, 'edit'])->name('buyerseller.edit');
    Route::post('buyerseller/{id}/update', [BuyerSellerDataController::class, 'update'])->name('buyerseller.update');


    //All Buyer Data to Edit
    Route::get('/SellerDataShow', function () {
        return view('admin.SellerDataShow');
    })->name('SellerDataShow');
    Route::get('seller/data', [BuyerSellerDataController::class, 'getSellerData'])->name('seller.data');
    Route::get('seller/{id}/edit', [BuyerSellerDataController::class, 'sellerEdit'])->name('seller.edit');
    Route::post('seller/{id}/update', [BuyerSellerDataController::class, 'sellerUpdate'])->name('seller.update');

    
    Route::get('/admin/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('/admin/notifications/store', [AdminNotificationController::class, 'store'])->name('admin.notifications.store');
    Route::get('/admin/notifications/show', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');


    // Route::post('/tickets/{id}/close', [TicketController::class, 'close'])->name('tickets.close');
    // Route::post('/tickets/{id}/open', [TicketController::class, 'open'])->name('tickets.open');
    Route::get('/admin/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/{id}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::post('/admin/tickets/{id}/close', [AdminTicketController::class, 'close'])->name('admin.tickets.close');
    Route::post('/admin/tickets/{id}/response', [AdminTicketController::class, 'storeResponse'])->name('admin.tickets.response.store');
    Route::post('/admin/tickets/search', [AdminTicketController::class, 'search'])->name('admin.tickets.search');




    //package
    Route::resource('packages', PackageController::class);
    
    Route::get('assginPackages/', [PackageController::class, 'assginPackages'])->name('assginPackages');
    Route::get('/assign-package', [PackageController::class, 'createAssignForm'])->name('assign.create');
    Route::post('/assign-package', [PackageController::class, 'storeAssignedPackage'])->name('assign.store');
    Route::get('/emailSearch', [PackageController::class, 'emailSearch'])->name('emailSearch');
    Route::get('/view-assign-package', [PackageController::class, 'viewAssign'])->name('viewAssign');
    Route::delete('/delete-assign-package/{id}', [PackageController::class, 'deleteAssign'])->name('deleteAssign');
    Route::get('/assigned-package/edit/{id}', [PackageController::class, 'editGetAssignedPackage'])->name('editGetAssignedPackage');
    Route::post('/assigned-package/edit/{id}', [PackageController::class, 'editAssignedPackage'])->name('editAssignedPackage');



    Route::get('/marquee', [MarqueeController::class, 'index'])->name('marquee.index');
    Route::post('/marquee', [MarqueeController::class, 'store'])->name('marquee.store');
    Route::put('/marquee/{id}', [MarqueeController::class, 'update'])->name('marquee.update');
    Route::delete('/marquee/{id}', [MarqueeController::class, 'destroy'])->name('marquee.destroy');


    Route::get('/reports', [BuyerSellerDataController::class, 'reports'])->name('reports');
    

});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/service', function () {
    return view('service');
})->name('service');



Route::get('/whyus', function () {
    return view('whyus');
})->name('whyus');



Route::get('/whatwedo', function () {
    return view('whatwedo');
})->name('whatwedo');



Route::get('/faq', function () {
    return view('faq');
})->name('faq');




Route::get('/terms', function () {
    return view('terms');
})->name('terms');


Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/customers/store1', [CustomerAuthController::class, 'store1'])->name('customers.store1');


// Dashboard route, protected by auth middleware
// routes/web.php



Route::get('customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
// Route::get('customer/signup', [CustomerAuthController::class, 'showSignupForm'])->name('customer.signup');
Route::post('customer/login', [CustomerAuthController::class, 'login']);
Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('password/forgot', [CustomerAuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('password/forgot', [CustomerAuthController::class, 'checkEmailExists'])->name('password.forgot.check');
Route::get('password/change', [CustomerAuthController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('password/change', [CustomerAuthController::class, 'updatePassword'])->name('password.update');



Route::middleware('auth:customer')->group(function () {
    Route::get('customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('customer/search', [CustomerDashboardController::class, 'searchView'])->name('customer.search');
    Route::post('customer/search', [CustomerDashboardController::class, 'search'])->name('customer.postSearch');
    Route::get('customer/point-history', [CustomerDashboardController::class, 'pointHistory'])->name('customer.pointHistory');
    Route::post('customer/buy-lead', [CustomerDashboardController::class, 'buyLead'])->name('customer.buy-lead');
    Route::get('customer/buy-lead-sec', [CustomerDashboardController::class, 'buyLeadSec'])->name('customer.buyLeadSec');
    Route::get('customer/buy-lead-section', [CustomerDashboardController::class, 'buyLeadSection'])->name('customer.buyLeadSection');
    Route::get('customer/supplier-lead-section', [CustomerDashboardController::class, 'supplierLeadSection'])->name('customer.supplierLeadSection');
    Route::get('customer/get-row-data', [CustomerDashboardController::class, 'getRowDatas'])->name('customer.getRowData');
    // Route::post('customer/get-row-data', 'CustomerDashboardController@getRowData');


    Route::get('/get-hsn02-data', [CustomerDashboardController::class, 'getHSN02Data']);
    Route::post('/get-hsn-data-by-prefix', [CustomerDashboardController::class, 'getHSNDataByPrefix']);
    Route::get('/search-hsn', function (Request $request) {
        $searchTerm = $request->input('searchTerm'); // Get the search term from the request
    
        // Perform the search across all four tables using raw SQL queries
        $hsn02Results = DB::table('hsn_02')
                          ->where('hsn_02_code', 'LIKE', "%$searchTerm%")
                          ->orWhere('hsn_02_desc', 'LIKE', "%$searchTerm%")
                          ->get();
    
        $hsn04Results = DB::table('hsn_04')
                          ->where('hsn_04_code', 'LIKE', "%$searchTerm%")
                          ->orWhere('hsn_04_desc', 'LIKE', "%$searchTerm%")
                          ->get();
    
        $hsn06Results = DB::table('hsn_06')
                          ->where('hsn_06_code', 'LIKE', "%$searchTerm%")
                          ->orWhere('hsn_06_desc', 'LIKE', "%$searchTerm%")
                          ->get();
    
        $hsn08Results = DB::table('hsn_08')
                          ->where('hsn_08_code', 'LIKE', "%$searchTerm%")
                          ->orWhere('hsn_08_desc', 'LIKE', "%$searchTerm%")
                          ->get();
    
        // Combine all results
        $combinedResults = $hsn02Results->merge($hsn04Results)->merge($hsn06Results)->merge($hsn08Results);
    
        // Return the combined results as JSON
        return response()->json([
            'status' => 'success',
            'data' => $combinedResults
        ]);
    });



    Route::post('customer/filter-results', [CustomerDashboardController::class, 'filterResults'])->name('customer.filterResults');

    Route::get('/companiesBuyer/{buyer_name}', [CustomerDashboardController::class, 'showCompaniesBuyer'])->name('companies.showBuyer');
    Route::get('/companiesSupplier/{buyer_name}', [CustomerDashboardController::class, 'showCompaniesSupplier'])->name('companies.showSupplier');

    Route::post('customer/save-report', [CustomerDashboardController::class, 'saveReport'])->name('customer.saveReport');

    Route::post('/favorites/store', [CustomerDashboardController::class, 'store'])->name('favorites.store');
    Route::post('/favorites/delete', [CustomerDashboardController::class, 'delete'])->name('favorites.delete');
    Route::get('/favorites/list', [CustomerDashboardController::class, 'list'])->name('favorites.list');
    Route::get('customer/favorites/{customerId}', [CustomerDashboardController::class, 'getFavoritesForCustomer']);

    Route::get('/profile/{customerId}', [CustomerDashboardController::class, 'getProfileForCustomer']);
    // Route::get('/profile/{customerId}', [CustomerDashboardController::class, 'getProfileForCustomer']);
    Route::get('/seeNotification/{customerId}', [CustomerDashboardController::class, 'seeNotification']);
    Route::get('/notifications/count', [CustomerDashboardController::class, 'count'])->name('notifications.count');


    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/close', [TicketController::class, 'close'])->name('tickets.close');
    Route::post('/tickets/{id}/response', [TicketResponseController::class, 'store'])->name('tickets.response.store');
    Route::post('/tickets/{id}/open', [TicketController::class, 'open'])->name('tickets.open');
});


//customer login
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth', 'isCustomer'])->group(function () {

//     Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('customer/dashboard');
//     Route::get('/search', [SearchController::class, 'searchView'])->name('customer/search');
//     Route::post('/search', [SearchController::class, 'search'])->name('search');

// });







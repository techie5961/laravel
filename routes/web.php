<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsDashboardController;
use App\Http\Controllers\AdminsGetRequestController;
use App\Http\Controllers\AdminsPostRequestController;
use App\Http\Controllers\UsersPostRequestController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserGetRequestController;
use App\Http\Middleware\UsersAuthMiddleware;
use App\Http\Middleware\UsersDashboardMiddleware;
use App\Http\Middleware\AdminsAuthMiddleware;
use App\Http\Middleware\AdminsDashhboardMiddleware;



// update admin password
Route::get('hash',[
    AdminsGetRequestController::class,'UpdateAdminPassword'
]);
Route::get('/', function () {
    return view('welcome');
});

// users





// ADMINS GET REQUEST
// admin auth middleware
Route::middleware([AdminsAuthMiddleware::class])->group(function(){
// admins login
Route::get('admins/login',[
 AdminsDashboardController::class,'Login'
]);
});

// admin dashboard middleware
Route::middleware([AdminsDashhboardMiddleware::class])->group(function(){
    // admins dashboard
Route::get('admins/dashboard',[
    AdminsDashboardController::class,'Dashboard'
]);
// all transactions
Route::get('admins/transactions',[
    AdminsDashboardController::class,'Transactions'
]);
// transaction receipt
Route::get('admins/transaction/receipt',[
    AdminsDashboardController::class,'TransactionReceipt'
]);
// search transactions
Route::get('admins/search/transactions',[
    AdminsGetRequestController::class,'SearchTransactions'
]);

// approve transaction
Route::get('admins/approve/transaction/process',[
    AdminsGetRequestController::class,'ApproveTransaction'
]);
// reject transaction
Route::get('admins/reject/transaction/process',[
    AdminsGetRequestController::class,'RejectTransaction'
]);

// all users
Route::get('admins/users',[
    AdminsDashboardController::class,'AllUsers'
]);

// search users
Route::get('admins/search/users',[
    AdminsGetRequestController::class,'SearchUsers'
]);

// user
Route::get('admins/user',[
    AdminsDashboardController::class,'User'
]);

// login as user
Route::get('admins/login/as/user',[
   AdminsGetRequestController::class,'LoginAsUser'
]);
// ban user
Route::get('admins/ban/user',[
    AdminsGetRequestController::class,'BanUser'
]);
// unban user
Route::get('admins/unban/user',[
    AdminsGetRequestController::class,'UnbanUser'
]);
// site settings
Route::get('admins/settings',[
    AdminsDashboardController::class,'SiteSettings'
]);
// notifications
Route::get('admins/notifications',[
    AdminsDashboardController::class,'Notifications'
]);
// mark notofication as read
Route::get('admins/notification/mark/as/read',[
   AdminsGetRequestController::class,'MarkNotificationAsRead'
]);
// mark all as read
Route::get('admins/notifications/mark/all/as/read',[
    AdminsGetRequestController::class,'MarkAllNotificationAsRead'
]);
// logout
Route::get('admins/logout',[
    AdminsDashboardController::class,'Logout'
]);


// ADMINS POST REQUEST(authenticated)
// credit user
Route::post('admins/post/credit/user/process',[
    AdminsPostRequestController::class,'CreditUser'
]);
// debit user
Route::post('admins/post/debit/user/process',[
    AdminsPostRequestController::class,'DebitUser'
]);
// general settings
Route::post('admins/post/general/settings/process',[
    AdminsPostRequestController::class,'GeneralSettings'
]);
// social settings
Route::post('admins/post/social/settings/process',[
    AdminsPostRequestController::class,'SocialSettings'
]);


// admins dashboard middleware close
});


// ADMINS POST REQUEST(Non-Authenticated)
Route::post('admins/post/login/process',[
    AdminsPostRequestController::class,'Login'
]);

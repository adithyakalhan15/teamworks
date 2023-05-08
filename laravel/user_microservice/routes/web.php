<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\users\AuthenticateUserController;
use App\Http\Controllers\users\ResetUserPasswordController;
use App\Http\Controllers\users\SignUpController;
use App\Http\Controllers\users\AccountManagementController;
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//This is an api microservice. So, all the api routs will be defined here.
//Base url will be http://localhost/api/users/
Route::get('/', function () {
    return view('welcome');
})->name("login");


//auth or login
Route::prefix("auth")->controller(AuthenticateUserController::class)->group(function (){
    Route::post("login", "LoginToAccount"); 
    Route::post("invalidate-api-key", "InvalidateApiKey");
    Route::post("validate-api-key", "ValidateApiKey");
});


//Password reset
Route::prefix("pwreset")->controller(ResetUserPasswordController::class)->group(function (){
    Route::post("request-password-reset", "RequestPasswordReset");
    Route::post("reset-password", "PasswordResetFromToken");
});


//Signup //request-password-reset 
Route::prefix("signup")->controller(SignUpController::class)->group(function (){
    Route::post("create-user-account", "CreateUserAccount");
    Route::post("create-researcher-account", "CreateResearcherAccount");
    Route::middleware(['auth:admin'])->post("create-admin-account", "CreateAdminAccount");
    
    Route::middleware(['auth:admin'])->post("approve-researcher-account", "ApproveResearcherAccount");
});


//Account management
Route::prefix("account")->controller(AccountManagementController::class)->group(function (){
    Route::post("get-account-list", "GetAllAccountList");
    Route::post("get-account-details", "CreateUserAccount");
    Route::post("set-account-details", "CreateResearcherAccount");
});
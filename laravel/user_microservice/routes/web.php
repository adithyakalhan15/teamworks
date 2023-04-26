<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\AuthenticateUserController;
use App\Http\Controllers\users\SignUpController;
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
});

Route::get('/signup', function () {
    return view('welcome');
});
//auth or login
Route::prefix("auth")->controller(SignUpController::class)->group(function (){
    Route::post("login", "LoginToAccount");
    Route::post("invalidate-api-key", "InvalidateApiKey");
    Route::post("validate-api-key", "ValidateApiKey");
});


//Password reset
Route::prefix("pwreset")->controller(SignUpController::class)->group(function (){
    Route::post("request-password-reset", "CreateUserAccount");
    Route::post("reset-password", "CreateResearcherAccount");
});


//Signup //request-password-reset
Route::prefix("signup")->controller(SignUpController::class)->group(function (){
    Route::post("create-user-account", "CreateUserAccount");
    Route::post("create-researcher-account", "CreateResearcherAccount");
    Route::post("create-admin-account", "CreateAdminAccount");

    Route::post("approve-researcher-account", "ApproveResearcherAccount");

});
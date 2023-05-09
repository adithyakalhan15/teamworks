<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\users\AuthenticateUserController;
use App\Http\Controllers\users\ResetUserPasswordController;
use App\Http\Controllers\users\SignUpController;
use App\Http\Controllers\users\AccountManagementController;

use App\Http\Controllers\MongoTestController;
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


Route::middleware(['web'])->group(function () {
    Route::get('/addnew2', "App\Http\Controllers\MongoTestController@AddElement");
});
Route::get('/addnew', "App\Http\Controllers\MongoTestController@AddElement");
Route::get('/get', "App\Http\Controllers\MongoTestController@GetElement");


/*
Route::group([
        'middleware' => ['api', 'cors'],
        'namespace' => $this->namespace,
        'prefix' => 'api',
    ], function ($router) {
         //Add you routes here, for example:
         Route::apiResource('/posts','PostController');
    });

*/
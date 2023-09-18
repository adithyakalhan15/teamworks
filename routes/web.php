<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\Homepage\HomePageController::class, 'ShowHomePage'])->name('home');
Route::get('/search', [App\Http\Controllers\Publications\SearchPageController::class, 'ShowSearchPage'])->name('search');
Route::get('/author/{auther_slug}', [App\Http\Controllers\Publications\PublicationsPagesController::class, 'ShowAutherPage']);
Route::get('/publication/{publication_slug}', [App\Http\Controllers\Publications\PublicationsPagesController::class, 'ShowPublicationPage']);

/**
 * User pages
 */
Route::prefix('/user')->group(function () {
    Route::get('/login',    [App\Http\Controllers\User\LoginController::class, 'ShowLoginPage'])->name('login');
    Route::post('/login',    [App\Http\Controllers\User\LoginController::class, 'AttemptLogin']);
    Route::get('/register', [App\Http\Controllers\User\RegisterController::class, 'ShowRegisterPage'])->name('register');
    Route::get('/logout',   [App\Http\Controllers\User\LoginController::class, 'Logout'])->name('logout');

    Route::prefix('/profile')->middleware('auth')->group(function (){
        Route::get('/',             [App\Http\Controllers\User\AccountController::class, 'ShowProfilePage']);
        Route::get('/edit',         [App\Http\Controllers\User\ProfileController::class, 'ShowEditProfilePage']);
        //Route::get('/publications', [App\Http\Controllers\User\ProfileController::class, 'ShowChangePasswordPage']);
    });

    Route::prefix('/editor')->middleware('auth:author')->group(function (){
        Route::get('/',                   [App\Http\Controllers\Publications\EditorController::class, 'ShowNewDocumentPage']);
        Route::get('/wizard',             [App\Http\Controllers\Publications\NewPublicationWizard::class, 'ShowNewPublicationWizard']);
        Route::post('/wizard',            [App\Http\Controllers\Publications\NewPublicationWizard::class, 'PWProcessSelection']);
        Route::get('/{publication_slug}', [App\Http\Controllers\Publications\EditorController::class, 'ShowEditorPage']);
    });
});

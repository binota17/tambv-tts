<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/products/home', function () {
    return view('products.home');
});

Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('dashboard', function() {
    return view('dashboard');
})->middleware('auth:user')->name('dashboard');


Route::prefix('admin')->group(function () {
    Route::get('register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [AdminController::class, 'register']);
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('dashboard', function() {
        return view('admin.dashboard');
    })->middleware('auth:admin')->name('admin.dashboard');
    
});
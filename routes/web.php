<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;

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

// guest user routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');    
    Route::post('auth/save', [MainController::class, 'save'])->name('auth.save');
    Route::post('auth/check', [MainControlleR::class, 'check'])->name('auth.check');
    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
});



Route::group(['middleware' => 'auth'], function () {

    // admin routes
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/employeeList', [HomeController::class, 'employeeList'])->name('pages.employeeList');       
        Route::resource('department', DepartmentController::class);
        Route::resource('designation', DesignationController::class);
    });

    // user routes
    Route::group(['prefix' => 'user', 'middleware' => 'is_user'], function () {
        Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/profile', [HomeController::class, 'user_profile'])->name('pages.profile');
        Route::post('/profileUpdate', [HomeController::class, 'updateProfile'])->name('profileUpdate');
       
    });

    Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');

});

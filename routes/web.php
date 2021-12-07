<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\NoticeController;

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
        Route::get('leavestype', [LeaveController::class, 'index'])->name('admin.leavestype');
        Route::post('addleave', [LeaveController::class, 'add_leaves_type'])->name('admin.addleave');
        Route::post('leavetypebyID/{id?}', [LeaveController::class, 'leavetypebyID'])->name('admin.editleave');
        Route::get('deleteleave/{id?}', [LeaveController::class, 'LeavetypeDelet'])->name('admin.deleteleave');                       
        Route::post('addholiday', [HolidayController::class, 'add_holiday'])->name('pages.addholiday');
        Route::post('holidaybyID/{id?}', [HolidayController::class, 'holidaybyID'])->name('admin.editholiday');
        Route::get('deleteholiday/{id?}', [HolidayController::class, 'holidayDelet'])->name('admin.deleteholiday');
        Route::post('updateStatus/{id?}', [HomeController::class, 'updateStatus'])->name('pages.updateStatus');        
        Route::get('approveleave/{id?}', [LeaveController::class, 'approveleave'])->name('admin.approveleave');
        Route::Post('noticeStore', [NoticeController::class, 'add_notice'])->name('noticeStore');
        Route::get('deleteNotice/{id}', [NoticeController::class, 'noticeDelete'])->name('deleteNotice');
    });

    // user routes
    Route::group(['prefix' => 'user', 'middleware' => 'is_user'], function () {
        Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/profile', [HomeController::class, 'user_profile'])->name('pages.profile');
        Route::post('/profileUpdate', [HomeController::class, 'updateProfile'])->name('profileUpdate');
        Route::post('getleavebyID/{id?}', [LeaveController::class, 'getleavebyID'])->name('admin.fetchleave'); 
        Route::post('addapplication', [LeaveController::class, 'add_application'])->name('admin.addapplication');       
        //Route::get('leaveapprove', [LeaveController::class, 'leaveapplication'])->name('pages.leaveapprove');
       
    });
    Route::get('allholidays', [HolidayController::class, 'index'])->name('pages.holidays');
    Route::get('leaveapprove', [LeaveController::class, 'leaveapplication'])->name('pages.leaveapprove');
    Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');

});

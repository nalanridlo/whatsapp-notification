<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;

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
//login screen
Route::get('/', function () {
    return view('layouts.welcome');
});
//auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/device', [DashboardController::class, 'getDevice'])->name('device'); //get index from device on dashboard
Route::get('/users', [DashboardController::class, 'getUsers'])->name('users'); //get index from users on dashboard

//users/reminders
Route::post('/users/store', [ReminderController::class, 'storeUsers'])->name('users.storeUsers');
Route::delete('/reminders/{reminder}', [ReminderController::class, 'delete'])->name('reminders.delete');
Route::get('/reminders/search', 'ReminderController@search')->name('reminders.search');

//device
Route::post('/devices/store', [DeviceController::class, 'store'])->name('devices.store');
Route::post('/devices/store', [DeviceController::class, 'storeDevice'])->name('devices.storeDevice');
Route::post('/devices/{device}/request-otp', [DeviceController::class, 'requestOtp'])->name('devices.requestOtp');
Route::post('/devices/{device}/delete', [DeviceController::class, 'delete'])->name('devices.delete');
Route::post('/devices/{device}/disconnect', [DeviceController::class, 'disconnect'])->name('devices.disconnect');
Route::post('/devices/{device}/reconnect', [DeviceController::class, 'reconnect'])->name('devices.reconnect');

// notification
Route::post('notifications/store', [NotificationController::class, 'store'])->name('notifications.store');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonnteController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('layouts.welcome');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/users', [DashboardController::class, 'users'])->name('users');
Route::post('/users/store', [DashboardController::class, 'storeUsers'])->name('users.storeUsers');

Route::get('/device', [DashboardController::class, 'device'])->name('device');
Route::post('/device/store', [DashboardController::class, 'storeDevice'])->name('device.storeDevice');
Route::post('/device/{device}/disconnect', [DashboardController::class, 'disconnect'])->name('device.disconnect');
Route::post('/device/{device}/requst-otp', [DashboardController::class, 'requestOtp'])->name('device.requstOtp');
Route::post('/device/{device}/delete', [DashboardController::class, 'delete'])->name('device.delete');
Route::post('/device/{device}/disconnect', [DashboardController::class, 'disconnect'])->name('device.disconnect');
Route::post('/device/{device}/reconnect', [DashboardController::class, 'reconnect'])->name('device.reconnect');

Route::resource('reminders', ReminderController::class);

// routing reminders
Route::get('/reminders/create', [ReminderController::class, 'create'])->name('reminders.create');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');

// routing devices
Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
Route::post('/devices/store', [DeviceController::class, 'store'])->name('devices.store');
Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::post('/devices/{device}/request-otp', [DeviceController::class, 'requestOtp'])->name('devices.requestOtp');
Route::post('/devices/{device}/delete', [DeviceController::class, 'delete'])->name('devices.delete');
Route::post('/devices/{device}/disconnect', [DeviceController::class, 'disconnect'])->name('devices.disconnect');
Route::post('/devices/{device}/reconnect', [DeviceController::class, 'reconnect'])->name('devices.reconnect');



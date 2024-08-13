<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonnteController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavigationController;

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

// Authentication route
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Routes for main content with dynamic sidebar
Route::get('/dashboard', [NavigationController::class, 'dashboard'])->name('dashboard');
Route::get('/users', [NavigationController::class, 'users'])->name('users');
Route::get('/device', [NavigationController::class, 'device'])->name('device');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route::get('/dashboard', [ReminderController::class, 'dashboard'])->name('dashboard');

Route::post('/send-message', [FonnteController::class, 'sendMessage']);

Route::get('/send-message', [ReminderController::class, 'create'])->name('send-message.create');
Route::post('/send-message', [ReminderController::class, 'store'])->name('send-message.store');

// // routing reminders
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::get('/reminders/create', [ReminderController::class, 'create'])->name('reminders.create');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');

// // routing devices
Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
Route::post('/devices/store', [DeviceController::class, 'store'])->name('devices.store');
Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::get('/devices', [FonnteController::class, 'getDevices']);

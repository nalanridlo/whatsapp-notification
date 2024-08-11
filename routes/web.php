<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonnteController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
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
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard'); // Buat view dengan nama dashboard.blade.php
})->name('dashboard');

Route::get('/users', function () {
    return view('users'); // Buat view dengan nama users.blade.php
})->name('users');

Route::get('/device', function () {
    return view('device'); // Buat view dengan nama users.blade.php
})->name('device');

Route::get('/dashboard', [ReminderController::class, 'dashboard'])->name('dashboard');


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
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonnteController;
use App\Http\Controllers\ReminderController;

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

Route::post('/send-message', [FonnteController::class, 'sendMessage']);

Route::get('/send-message', [ReminderController::class, 'create'])->name('send-message.create');
Route::post('/send-message', [ReminderController::class, 'store'])->name('send-message.store');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::get('/reminders/create', [ReminderController::class, 'create'])->name('reminders.create');
Route::post('/reminders', [ReminderController::class, 'store'])->name('reminders.store');
Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');
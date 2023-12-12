<?php

use App\Providers\RouteServiceProvider;
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

Route::get('/', function () {
    return to_route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/application', [App\Http\Controllers\BookingController::class, 'index'])->name('application');
    Route::get('/application/booking/{booking}/{notificationId?}', [App\Http\Controllers\BookingController::class, 'show'])->name('application.show');
    Route::get('/application/{date}', [App\Http\Controllers\BookingController::class, 'create'])->name('application.date');
    Route::post('/application', [App\Http\Controllers\BookingController::class, 'store'])->name('application.store');
    Route::post('/application/booking/{booking}', [App\Http\Controllers\BookingController::class, 'update'])->name('application.update');
    Route::get('/application/booking/{booking}/edit', [App\Http\Controllers\BookingController::class, 'edit'])->name('application.edit');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');
});

Route::group(['middleware'=> ['auth', 'Admin']], function(){
    Route::post('/application/{booking}/approve', [App\Http\Controllers\BookingController::class, 'approve'])->name('application.approve');
    Route::post('/application/{booking}/reject', [App\Http\Controllers\BookingController::class, 'reject'])->name('application.reject');
});


Route::get('/test', function() {
    return view('test');
});
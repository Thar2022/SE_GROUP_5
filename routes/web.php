<?php

use App\Http\Controllers\BookingController;
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
    return view('admin/home');
});
Route::get('/guide',[BookingController::class,'guide'])->name('guide');
Route::get('/book',[BookingController::class,'booking'])->name('booking');
Route::get('/insert',[BookingController::class,'book_insert'])->name('book_insert');
Route::get('/from/{id}',[BookingController::class,'book_from'])->name('book_from');
Route::get('/edit/{id}',[BookingController::class,'book_edit'])->name('book_edit');
Route::get('/status',[BookingController::class,'book_status'])->name('book_status');
Route::post('/insert',[BookingController::class,'book_insert']);
Route::post('/update',[BookingController::class,'book_update']);
Route::get('/delete/{id}',[BookingController::class,'delete'])->name('delete');
Route::post('/accept_booking', [BookingController::class,'accept_booking'])->name('accept_booking');
Route::get('/delete_accept/{id}',[BookingController::class,'delete_accept'])->name('delete_accept');
// routes/ajax
Route::get('/ajax/time', [BookingController::class,'ajaxRequest_time']);
Route::get('/ajax/table', [BookingController::class,'ajaxRequest_table']);
Route::get('/ajax/date', [BookingController::class,'ajaxRequest_date']);


Route::prefix('admin')->group(function(){
    Route::get('/bookinguser',[BookingController::class,'bookinguser'])->name('bookinguser');
    Route::get('/bookingadmin',[BookingController::class,'bookingadmin'])->name('bookingadmin');
    Route::get('/update/{id}',[BookingController::class,'update2'])->name('update2');
});


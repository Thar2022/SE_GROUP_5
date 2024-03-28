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

Route::get('/admin/home', function () {
    return view('/admin/home');
});

Route::get('/admin/checkRoom', [AdminController::class, 'ShowCheckRoom']);
// Route::get('/admin/createCloseRoom/{id}', [AdminController::class, 'createCloseRoom'])->name('admin.createCloseRoom');
Route::get('/admin/closeRoom', [AdminController::class, 'closeRoom'])->name('admin.closeRoom');
Route::get('/admin/editCloseRoom/{id}', [AdminController::class, 'editCloseRoom'])->name('admin.editCloseRoom');
Route::get('/admin/updateCloseRoom/{id}', [AdminController::class, 'updateCloseRoom'])->name('admin.updateCloseRoom');
Route::get('/admin/brokeEquipment/{id}', [AdminController::class, 'brokeEquipment'])->name('admin.brokeEquipment');
Route::get('/admin/changeRoom', [AdminController::class, 'changeRoom'])->name('admin.changeRoom');
Route::get('/admin/editChangeRoom/{id}', [AdminController::class, 'editChangeRoom'])->name('admin.editChangeRoom');
Route::get('/admin/sentEmail/{id}', [AdminController::class, 'sentEmail'])->name('admin.sentEmail');
Route::get('/admin/allBooking', [AdminController::class, 'allBooking'])->name('admin.allBooking');
Route::get('/admin/deleteCloseRoom/{id}', [AdminController::class, 'deleteCloseRoom'])->name('admin.deleteCloseRoom');
Route::get('/admin/createCloseRoom/{id}', [AdminController::class, 'createCloseRoom'])->name('admin.createCloseRoom');
Route::get('/admin/addCloseRoom/{id}', [AdminController::class, 'addCloseRoom'])->name('admin.addCloseRoom');
Route::get('/admin/meetingRoom', [AdminController::class, 'meetingRoom'])->name('admin.meetingRoom');
Route::get('/admin/editRoom/{id}', [AdminController::class, 'editRoom'])->name('admin.editRoom');
Route::get('/admin/deleteRoom/{id}', [AdminController::class, 'deleteRoom'])->name('admin.deleteRoom');
Route::get('/admin/equipmentRoom', [AdminController::class, 'equipmentRoom'])->name('admin.equipmentRoom');
Route::get('/admin/createRoom', [AdminController::class, 'createRoom'])->name('admin.createRoom');
Route::get('/admin/addRoom', [AdminController::class, 'addRoom'])->name('admin.addRoom');





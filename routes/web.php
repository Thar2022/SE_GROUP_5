<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');
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

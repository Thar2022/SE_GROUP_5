<?php
use App\Http\Controllers\NeedRepairController;
use App\Http\Controllers\Report_RepairController;
use App\Http\Controllers\HistoryRepairController;
use App\Http\Controllers\HistoryDetailRepairController;
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

//technician

Route::get('technician/Report_Repair', [Report_RepairController::class, 'Report'])->name('report');

Route::get('/Detail/{id_checkroom}', [Report_RepairController::class, 'Detail'])->name('detail1');

Route::post('/estimate', [Report_RepairController::class, 'Estimate'])->name('estimate');



Route::get('/NeedRepair/{id_checkroom}', [NeedRepairController::class, 'NeedRepair'])->name('needRepair');

Route::get('/historyrepair', [HistoryRepairController::class, 'historyrepair'])->name('historyrepair');

Route::get('/deletehistoryrepair/{id}', [HistoryRepairController::class, 'delete'])->name('deletehistoryrepair');

Route::get('/historydetailrepair/{id_checkroom}', [HistoryDetailRepairController::class, 'Detail'])->name('detail');

Route::get('/waitrepair', [HistoryDetailRepairController::class, 'Wait'])->name('waitrepair');

Route::get('/NeedRepair/{id_checkroom}', [NeedRepairController::class, 'NeedRepair'])->name('needRepair');

Route::get('/datefix/{id}', [NeedRepairController::class, 'Datefix'])->name('datefix');

Route::post('/updatedate/{id}', [NeedRepairController::class, 'update'])->name('updatedate');

Route::get('/updatefinish/{id}', [NeedRepairController::class, 'updatefinish'])->name('updatefinish');

Route::get('/back/{id}', [NeedRepairController::class, 'Back'])->name('back');

//endTechnician
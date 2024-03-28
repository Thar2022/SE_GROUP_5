<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AdminController;
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
    return view('auth/login');
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
Route::get('/admin/updateChangeRoom{id}', [AdminController::class, 'updateChangeRoom'])->name('admin.updateChangeRoom');




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

//authen
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
 Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/admin', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/edit', [DataController::class, 'editPage']);
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/getuserdata', [DataController::class, 'getUserInfo'])->name('getuserdata');
    Route::get('/deleteUser', [DataController::class, 'deleteUser'])->name('deleteuser');
    Route::get('/editUser', [DataController::class, 'editUser'])->name('edituser');
    Route::get('/saveEditedUser', [DataController::class, 'saveEditedUser'])->name('saveEditedUser');
});
//end authen
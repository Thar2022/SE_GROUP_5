<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NeedRepairController;
use App\Http\Controllers\Report_RepairController;
use App\Http\Controllers\HistoryRepairController;
use App\Http\Controllers\HistoryDetailRepairController;



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


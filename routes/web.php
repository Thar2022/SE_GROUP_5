<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;


// Route::get('/', function () {
//     return view('index');
// });

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
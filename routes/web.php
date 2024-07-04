<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => ['role:super admin,admin']], function() {
    Route::get('/admin', [AdminController::class, 'index']);
});


Route::get('/register', [UserController::class, 'showRegisterForm'])->name('show-register-form');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/assign-role-form', [UserController::class, 'showAssignRoleForm'])->name('show-assign-role-form');
Route::post('/assign-role', [UserController::class, 'assignRole'])->name('assign-role');
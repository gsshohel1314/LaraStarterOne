<?php

use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['as'=>'app.', 'prefix'=>'app', 'middleware'=>['auth','preventBack']], function(){
//     Route::get('/dashboard', DashboardController::class)->name('dashboard');
//     Route::resource('roles', RoleController::class);
// });

Route::get('/dashboard', DashboardController::class)->name('dashboard');

// Roles and Users
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// Profile
Route::get('profile',[ProfileController::class, 'index'])->name('profile.index');
Route::put('profile',[ProfileController::class, 'update'])->name('profile.update');

// Security
Route::get('profile/security',[ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::put('profile/security',[ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Pages
Route::resource('pages', PageController::class);



//Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);


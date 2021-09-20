<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfileController;

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

Route::group(['as'=>'app.', 'prefix'=>'app', 'middleware'=>['auth']] ,function(){
    // Dashboard
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // Roles
    Route::resource('role', RoleController::class)->except(['show']);

    // Users
    Route::resource('user', UserController::class);

    // Profile
    Route::get('profile', [ProfileController::class, 'profileIndex'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'profileUpdate'])->name('profile.update');

    // Security
    Route::get('profile/security', [ProfileController::class, 'securityIndex'])->name('profile.security.index');
    Route::put('profile/security', [ProfileController::class, 'securityUpdate'])->name('profile.security.update');

    // Backups
    Route::resource('backup', BackupController::class)->only(['index', 'store', 'destroy']);
    Route::get('backup/{file_name}', [BackupController::class, 'download'])->name('backup.download');
    Route::delete('backup', [BackupController::class, 'clean'])->name('backup.clean');
});

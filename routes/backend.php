<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;

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

    // Settings
    Route::group(['as'=>'setting.', 'prefix'=>'setting'], function(){
        // General Setting
        Route::get('general', [SettingController::class, 'generalIndex'])->name('general.index');
        Route::put('general', [SettingController::class, 'generalUpdate'])->name('general.update');

        // Appearance Setting
        Route::get('appearance', [SettingController::class ,'appearanceIndex'])->name('appearance.index');
        Route::put('appearance', [SettingController::class ,'appearanceUpdate'])->name('appearance.update');

        // Mail Setting
        Route::get('mail', [SettingController::class ,'mailIndex'])->name('mail.index');
        Route::put('mail', [SettingController::class ,'mailUpdate'])->name('mail.update');
    });

    // Categories
    Route::resource('category', CategoryController::class)->except(['show']);

    // Products
    Route::resource('product', ProductController::class);

    // Stocks
    Route::resource('stock', StockController::class);
    Route::get('findProductName',[StockController::class, 'findProductName']);
    // Route::get('findPrice',[StockController::class, 'findPrice']);

    // Manage Stock
    Route::get('manage/stock', [StockController::class, 'manageStockIndex'])->name('manage.stock.index');
    Route::get('findProductQuantity',[StockController::class, 'findProductQuantity']);
    Route::post('manage/stock', [StockController::class, 'manageStockStore'])->name('manage.stock.store');

    // Stock History
    Route::get('manage/stock/history', [StockController::class, 'stockHistoryIndex'])->name('manage.stock.history.index');

});

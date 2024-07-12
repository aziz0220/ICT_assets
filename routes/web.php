<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetStandardController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role_or_permission:Asset Manager'])->group(function () {
        Route::resource('/asset', AssetController::class);
        Route::resource('/asset-category',AssetCategoryController::class);
        Route::resource('/asset-standard', AssetStandardController::class);
        Route::resource('/asset-status',AssetStatusController::class);
        Route::resource('/vendor',\App\Http\Controllers\VendorController::class);

    });

    Route::middleware(['role_or_permission:Staff|Executive Manager'])->group(function () {
        Route::resource('/asset', AssetController::class);
    });

    Route::middleware(['role_or_permission:System Admin'])->group(function(){
        Route::resource('/role', RoleController::class);
        Route::resource('/staff',\App\Http\Controllers\StaffController::class);
        Route::resource('/office',\App\Http\Controllers\OfficeController::class);
    });

});

require __DIR__.'/auth.php';

Auth::routes();

<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetStandardController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VendorController;
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

    Route::middleware(['role:Asset Manager'])->group(function () {
        Route::resource('/asset-category',AssetCategoryController::class);
        Route::resource('/asset-standard', AssetStandardController::class);
        Route::resource('/asset-status',AssetStatusController::class);
        Route::resource('/vendor',VendorController::class);
    });

    Route::middleware(['role:Asset Manager|Staff|Executive Manager'])->group(function () {
        Route::resource('asset', AssetController::class);
        Route::get('asset/create', 'App\Http\Controllers\AssetController@create')->name('asset.create');
    });

    Route::middleware(['role:System Admin'])->group(function(){
        Route::resource('/role', RoleController::class);
        Route::resource('/staff',StaffController::class);
        Route::resource('/office',OfficeController::class);
    });

});

require __DIR__.'/auth.php';

Auth::routes();

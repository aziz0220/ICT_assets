<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetChangeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetStandardController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Api;

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

    Route::middleware(['role:Asset Manager|Staff|Executive Manager','App\Http\Middleware\CheckStaffBlockStatus'])->group(function () {
        Route::resource('assets', AssetController::class);
        Route::resource('assetchanges', AssetChangeController::class);
//        Route::get('assets/create', 'App\Http\Controllers\AssetController@create')->name('assets.create');
//        Route::get('assets', 'App\Http\Controllers\AssetController@register')->name('assets.register');
//        Route::get('assets', 'App\Http\Controllers\AssetController@index')->name('assets.index');
    });

    Route::middleware(['role:System Admin'])->group(function(){
        Route::resource('/role', RoleController::class);
        Route::resource('/permission', PermissionController::class);
        Route::resource('/staff',StaffController::class);
        Route::get('/staff/block/{staff}',[StaffController::class,'block'])->name('staff.block');
        Route::get('/staff/unblock/{staff}',[StaffController::class,'unblock'])->name('staff.unblock');
        Route::resource('/user',UserController::class);
        Route::resource('/office',OfficeController::class);
    });

});




Route::group(['middleware' => Api::class, 'prefix' => 'api/v1'], function () {
    Route::get('biographies', [BiographyController::class, 'index']);
    Route::get('biographies/{id}', [BiographyController::class, 'show']);
    Route::get('biographies/details/{id}', [BiographyController::class, 'detail']);
//    Route::post('biographies', [BiographyController::class, 'store']);
//    Route::put('biographies/{id}', [BiographyController::class, 'update']);
//    Route::delete('biographies/{id}', [BiographyController::class, 'destroy']);
});


require __DIR__.'/auth.php';

Auth::routes();

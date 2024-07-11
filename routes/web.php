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

//      Route::post('/import',[AssetController::class,'import'])->name('import');
});

    Route::middleware(['role_or_permission:Staff|Executive Manager'])->group(function () {
        Route::resource('/asset', AssetController::class);

//      Route::post('/import',[AssetController::class,'import'])->name('import');
    });

    Route::middleware(['role_or_permission:System Admin'])->group(function(){
        Route::resource('/role', RoleController::class);
        Route::resource('/staff',\App\Http\Controllers\StaffController::class);
        Route::resource('/office',\App\Http\Controllers\OfficeController::class);
    });





//    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //    Route::get('/test', function () {
//        return view('permission_test');
//    });
//    Route::get('/add-permission', [RolesAndPermissionController::class, 'addPermission'])->name('add.permission');

//    Route::get('/assets', function() {
//        $assets = \App\Models\Asset::with('vendor')->latest()->simplePaginate(10);
//        return view('assets.index1', [
//            'assets' => $assets
//        ]);
//    });

    //    Route::get('/asset/{asset}/', [AssetController::class, 'show'])->name('assets.show');
//    Route::get('/asset/{asset}/edit/', [AssetController::class, 'edit'])->name('assets.edit');
//    Route::get('/asset/{asset}/delete/', [AssetController::class, 'destroy'])->name('assets.delete');
//    Route::get('/asset/new/', [AssetController::class, 'create'])->name('assets.create');
});

require __DIR__.'/auth.php';

Auth::routes();

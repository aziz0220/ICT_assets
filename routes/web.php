<?php

//use App\Http\Controllers\ProfileController;
//use Illuminate\Support\Facades\Route;
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//
//require __DIR__.'/auth.php';








use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesAndPermissionController;
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

    Route::middleware(['role_or_permission:Staff'])->group(function () {
        Route::resource('/asset', AssetController::class);
    });

    Route::resource('/role',RoleController::class);

//    Route::post('/import',[AssetController::class,'import'])->name('import');








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



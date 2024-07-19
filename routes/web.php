<?php
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetChangeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetStandardController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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
        Route::post('/assetchanges/{id}', [AssetChangeController::class, 'store'])->name('assetchanges.store');
        Route::put('assets/{id}/approve', [AssetController::class, 'approveNewRequest'])->name('assets.approve');


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
        Route::resource('/offices',OfficeController::class);
        Route::post('/offices/{office}/set-head', [OfficeController::class, 'setHead'])->name('offices.setHead');
        Route::post('/offices/{office}/remove-head', [OfficeController::class, 'removeHead'])->name('offices.removeHead');

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

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('contents', [ContentController::class, 'index'])->name('contents.index');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:creator'])->group(function () {
    Route::get('contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::post('contents', [ContentController::class, 'store'])->name('contents.store');
    Route::get('forums', [ForumController::class, 'index'])->name('forums.index');
    // Other creator routes
});

Route::middleware(['auth', 'role:publisher'])->group(function () {
//    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
//    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    // Other publisher routes
});

require __DIR__.'/auth.php';

Auth::routes();

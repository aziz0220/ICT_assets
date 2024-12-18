<?php
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetChangeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetMaintenanceController;
use App\Http\Controllers\AssetProblemController;
use App\Http\Controllers\AssetStandardController;
use App\Http\Controllers\AssetStatusController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Api;

require __DIR__.'/auth.php';

//Auth::routes();

Route::post('/assets/bulk-action', [AssetController::class, 'bulkAction'])->name('assets.bulk-action');
Route::post('/user/bulk-action', [UserController::class, 'bulkAction'])->name('user.bulk-action');
Route::post('/permission/bulk-action', [PermissionController::class, 'bulkAction'])->name('permission.bulk-action');
Route::post('/role/bulk-action', [RoleController::class, 'bulkAction'])->name('role.bulk-action');
Route::post('/staff/bulk-action', [StaffController::class, 'bulkAction'])->name('staff.bulk-action');
Route::post('/offices/bulk-action', [OfficeController::class, 'bulkAction'])->name('offices.bulk-action');

Route::resource('/',WelcomeController::class);

Route::get('search', SearchController::class)->name('search');

Route::middleware(['auth','role.check'])->group(function () {
    Route::resource('/dashboard',DashboardController::class);
    Route::middleware(['role:Asset Manager'])->group(function () {
        Route::resource('/asset-category',AssetCategoryController::class);
        Route::resource('/asset-standard', AssetStandardController::class);
        Route::resource('/asset-status',AssetStatusController::class);
        Route::resource('/vendor',VendorController::class);
        Route::get('/assets/assign', [AssetController::class, 'assignAssetToStaff'])->name('assets.assign');
        Route::post('/assets/assign', [AssetController::class,'assignAsset'])->name('assets.assign');
        Route::get('/assets/{id}/staff',[AssetController::class, 'assignStaff'])->name('assets.staff');
    });

    Route::middleware(['role:Asset Manager|Staff|Executive Manager|Head Office','App\Http\Middleware\CheckStaffBlockStatus'])->group(function () {
        Route::resource('assets', AssetController::class);
        Route::resource('assetchanges', AssetChangeController::class);
        Route::post('/assetchanges/{id}', [AssetChangeController::class, 'store'])->name('assetchanges.store');
        Route::put('assets/{id}/approve', [AssetController::class, 'approveNewRequest'])->name('assets.approve');
        Route::put('assets/{id}/approve-change', [AssetController::class, 'approveEditRequest'])->name('assets.approveChange');
        Route::put('assets/{id}/disapprove', [AssetController::class, 'disapproveNewRequest'])->name('assets.disapprove');
        Route::put('assets/{id}/disapprove-change', [AssetController::class, 'disapproveEditRequest'])->name('assets.disapproveChange');
        // Asset Problems
        Route::get('assets/{id}/problem', [AssetController::class, 'problemRequest'])->name('assets.problem');
        Route::post('assets/{id}/problem', [AssetProblemController::class, 'store'])->name('asset.problem.store');
        // Asset Maintenance
        Route::get('assets/{id}/maintenance', [AssetController::class, 'maintenanceRequest'])->name('assets.maintenance');
        Route::post('assets/{id}/maintenance', [AssetMaintenanceController::class, 'store'])->name('asset.maintenance.store');

        Route::resource('asset_problems', AssetProblemController::class);
        Route::resource('asset_maintenances', AssetMaintenanceController::class);
        Route::patch('/asset_problems/{id}/approve', [AssetProblemController::class, 'approve'])->name('asset_problems.approve');
        Route::patch('/asset_problems/{id}/resolve', [AssetProblemController::class, 'resolve'])->name('asset_problems.resolve');


        Route::patch('asset_maintenances/{id}/approve', [AssetMaintenanceController::class, 'approve'])->name('asset_maintenances.approve');
        Route::patch('asset_maintenances/{id}/resolve', [AssetMaintenanceController::class, 'resolve'])->name('asset_maintenances.resolve');
        Route::delete('asset_maintenances/{id}', [AssetMaintenanceController::class, 'destroy'])->name('asset_maintenances.destroy');

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
        Route::get('/offices/{office}/assign-staff', [OfficeController::class, 'assignStaffForm'])->name('offices.assignStaffForm');
        Route::post('/offices/{office}/assign-staff', [OfficeController::class, 'assignStaff'])->name('offices.assignStaff');
        Route::get('/staff/{staff}/edit-office', [OfficeController::class, 'editStaffOffice'])->name('staff.editOffice');
        Route::put('/staff/{staff}/update-office', [OfficeController::class, 'updateStaffOffice'])->name('staff.updateOffice');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});




Route::group(['middleware' => Api::class, 'prefix' => 'api/v1'], function () {
    Route::get('biographies', [BiographyController::class, 'index']);
    Route::get('biographies/{id}', [BiographyController::class, 'show']);
    Route::get('biographies/details/{id}', [BiographyController::class, 'detail']);
//    Route::post('biographies', [BiographyController::class, 'store']);
//    Route::put('biographies/{id}', [BiographyController::class, 'update']);
//    Route::delete('biographies/{id}', [BiographyController::class, 'destroy']);
});

Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('contents', [ContentController::class, 'index'])->name('contents.index');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
//    Route::get('profile/edit', [UserController::class, 'edit'])->name('profile.edit');
//    Route::put('profile', [UserController::class, 'update'])->name('profile.update');
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

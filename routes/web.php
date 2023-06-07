<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\SuperAdmin\ServicesController;
use App\Http\Controllers\SuperAdmin\DivisionController;
use App\Http\Controllers\SuperAdmin\TraineeController;
use App\Http\Controllers\SuperAdmin\UnitsController;
use App\Http\Controllers\SuperAdmin\UnitCapacityController;
use App\Http\Controllers\SuperAdmin\RotationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::namespace('Admin')->prefix("admin")->group(function () {
    Route::get('login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('forgot-password', function () {
        return view('admin.forgotpssword');
    })->name('admin.forgot.password');
    Route::post('for-password', [AuthController::class, 'forgotPassword'])->name('admin.forgot.password.post');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('admin.reset.password.post');
});

Route::group(['prefix' => 'superadmin', "middleware" => ['is_super_admin']], function () {
    Route::get('dashboard', [SuperAdminDashboardController::class, 'dashboard'])->name('super.admin.dashboard');

    Route::resource('profile', ProfileController::class);
    Route::post('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password');

    Route::resource('divisions', DivisionController::class);
    Route::post('divisions/datatable', [DivisionController::class, 'datatable'])->name('super.admin.divisions.datatable');

    Route::resource('units', UnitsController::class);
    Route::post('units/datatable', [UnitsController::class, 'datatable'])->name('super.admin.units.datatable');

    Route::resource('unitscapacity', UnitCapacityController::class);
    Route::post('unitscapacity/datatable', [UnitCapacityController::class, 'capacityDatatable'])->name('super.admin.unit.capacity.datatable');
    Route::post('unitscapacity/manageupdate', [UnitCapacityController::class, 'TraineeUnitsCapacityUpdate'])->name('super.admin.unit.capacity.manage.update');
    // Route::get('unit/capacity', [UnitsController::class, 'capacity'])->name('super.admin.unit.capacity');
    // Route::get('unit/capacity', [UnitsController::class, 'capacity'])->name('super.admin.unit.capacity');
    Route::post('unit/capacity/update', [UnitsController::class, 'capacityUpdate'])->name('super.admin.unit.capacity.update');

    Route::get('learning-specialty', [ServicesController::class, 'learningSpecialty'])->name('super.admin.learning.specialty');
    Route::get('rotations', [ServicesController::class, 'rotations'])->name('super.admin.rotations.index');
    Route::get('reporting', [ServicesController::class, 'reporting'])->name('super.admin.reporting.index');

    Route::resource('trainee', TraineeController::class);
    Route::get('trainees/type-programs', [TraineeController::class, 'typePrograms'])->name('super.admin.type.programs');
    Route::post('trainee/datatable', [TraineeController::class, 'datatable'])->name('super.admin.unit.trainee.datatable');
    Route::get('trainees/import', [TraineeController::class, 'traineeImport'])->name('super.admin.trainee.import');
    Route::post('trainees/import/store', [TraineeController::class, 'traineeImportStore'])->name('super.admin.trainee.import.store');
    // Route::get('trainee', [TraineeController::class, 'index'])->name('super.admin.trainee');
    // Route::get('trainee/create', [TraineeController::class, 'create'])->name('super.admin.trainee.create');

    Route::post('ls/units', [TraineeController::class, 'LSUnits'])->name('super.admin.ls.units');

    Route::resource('rotation', RotationController::class);
    Route::get('rotation/show/{id}/{rotation}', [RotationController::class, 'show'])->name('rotation.show');
    Route::post('rotation/datatable', [RotationController::class, 'datatable'])->name('rotation.datatable');
    Route::post('rotation/datatable-dtl', [RotationController::class, 'datatableDTL'])->name('rotation.datatable.dtl');
});

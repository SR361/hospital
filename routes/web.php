<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\ServicesController;
use App\Http\Controllers\SuperAdmin\DivisionController;
use App\Http\Controllers\SuperAdmin\TraineeController;
use App\Http\Controllers\SuperAdmin\UnitsController;
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
});

Route::group(['prefix' => 'superadmin', "middleware" => ['is_super_admin']], function () {
    Route::get('dashboard', [SuperAdminDashboardController::class, 'dashboard'])->name('super.admin.dashboard');

    Route::resource('divisions', DivisionController::class);
    Route::post('divisions/datatable', [DivisionController::class, 'datatable'])->name('super.admin.divisions.datatable');
    // Route::get('divisions', [ServicesController::class, 'divisions'])->name('super.admin.divisions');

    Route::resource('units', UnitsController::class);
    Route::post('units/datatable', [UnitsController::class, 'datatable'])->name('super.admin.units.datatable');
    // Route::get('units', [ServicesController::class, 'units'])->name('super.admin.units');
    // Route::get('units/create', [ServicesController::class, 'unitsCreate'])->name('super.admin.units.create');

    Route::get('learning-specialty', [ServicesController::class, 'learningSpecialty'])->name('super.admin.learning.specialty');

    Route::get('rotations', [ServicesController::class, 'rotations'])->name('super.admin.rotations.index');

    Route::get('reporting', [ServicesController::class, 'reporting'])->name('super.admin.reporting.index');

    Route::get('trainee/type-programs', [TraineeController::class, 'typePrograms'])->name('super.admin.type.programs');
    Route::get('trainee', [TraineeController::class, 'index'])->name('super.admin.trainee');
    Route::get('trainee/create', [TraineeController::class, 'create'])->name('super.admin.trainee.create');

});

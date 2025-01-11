<?php

use App\Http\Controllers\AppUtilsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Route;

// utilities for upgrading
Route::get('/cmd/run', [AppUtilsController::class, 'run']);

Route::get('/', function () {
    return view('index');
})->name('home');

Route::middleware([Auth::class])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');

    Route::prefix('reports')->group(function () {
        Route::get('', [ReportController::class, 'index'])->name('report.index');
        Route::get('data', [ReportController::class, 'index'])->name('report.data');
    });

    // Route::prefix('teams')->group(function () {
    //     Route::get('', [TeamController::class, 'index'])->name('team.index');
    //     Route::get('data', [TeamController::class, 'data'])->name('team.data');
    //     Route::match(['get', 'post'], 'edit', [TeamController::class, 'edit'])->name('team.edit');
    //     Route::post('save', [TeamController::class, 'save'])->name('team.save');
    //     Route::post('delete/{id}', [TeamController::class, 'delete'])->name('team.delete');
    // });

    // Route::prefix('trainings')->group(function () {
    //     Route::get('', [TrainingController::class, 'index'])->name('training.index');
    //     Route::get('data', [TrainingController::class, 'data'])->name('training.data');
    //     Route::match(['get', 'post'], 'create', [TrainingController::class, 'create'])->name('training.create');
    //     Route::post('save', [TrainingController::class, 'save'])->name('training.save');
    //     Route::post('delete/{id}', [TrainingController::class, 'delete'])->name('training.delete');
    //     Route::get('run', [TrainingController::class, 'run'])->name('training.run');
    //     Route::get('view', [TrainingController::class, 'view'])->name('training.view');
    // });

    Route::prefix('settings')->group(function () {
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

        Route::prefix('users')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('user.index');
            Route::get('data', [UserController::class, 'data'])->name('user.data');
            Route::get('add', [UserController::class, 'editor'])->name('user.add');
            Route::get('edit/{id}', [UserController::class, 'editor'])->name('user.edit');
            Route::post('save', [UserController::class, 'save'])->name('user.save');
            Route::post('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        });
    });
});

require_once __DIR__ . '/api.php';
require_once __DIR__ . '/auth.php';

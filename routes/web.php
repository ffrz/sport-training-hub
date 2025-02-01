<?php

use App\Http\Controllers\AppUtilsController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGroupController;
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

    Route::prefix('management')->group(function () {
        Route::prefix('student-groups')->group(function () {
            Route::get('', [StudentGroupController::class, 'index'])->name('student-group.index');
            Route::get('data', [StudentGroupController::class, 'data'])->name('student-group.data');
            Route::get('add', [StudentGroupController::class, 'editor'])->name('student-group.add');
            Route::get('duplicate/{id}', [StudentGroupController::class, 'duplicate'])->name('student-group.duplicate');
            Route::get('edit/{id}', [StudentGroupController::class, 'editor'])->name('student-group.edit');
            Route::post('save', [StudentGroupController::class, 'save'])->name('student-group.save');
            Route::post('delete/{id}', [StudentGroupController::class, 'delete'])->name('student-group.delete');
            Route::get('detail/{id}', [StudentGroupController::class, 'detail'])->name('student-group.detail');
        });

        Route::prefix('students')->group(function () {
            Route::get('', [StudentController::class, 'index'])->name('student.index');
            Route::get('data', [StudentController::class, 'data'])->name('student.data');
            Route::get('add', [StudentController::class, 'editor'])->name('student.add');
            Route::get('duplicate/{id}', [StudentController::class, 'duplicate'])->name('student.duplicate');
            Route::get('detail/{id}', [StudentController::class, 'detail'])->name('student.detail');
            Route::get('edit/{id}', [StudentController::class, 'editor'])->name('student.edit');
            Route::post('save', [StudentController::class, 'save'])->name('student.save');
            Route::post('delete/{id}', [StudentController::class, 'delete'])->name('student.delete');
        });

        Route::prefix('coaches')->group(function () {
            Route::get('', [CoachController::class, 'index'])->name('coach.index');
            Route::get('data', [CoachController::class, 'data'])->name('coach.data');
            Route::get('add', [CoachController::class, 'editor'])->name('coach.add');
            Route::get('edit/{id}', [CoachController::class, 'editor'])->name('coach.edit');
            Route::post('save', [CoachController::class, 'save'])->name('coach.save');
            Route::post('delete/{id}', [CoachController::class, 'delete'])->name('coach.delete');
            Route::get('duplicate/{id}', [CoachController::class, 'duplicate'])->name('coach.duplicate');
            Route::get('detail/{id}', [CoachController::class, 'detail'])->name('coach.detail');
        });
    });

    Route::prefix('settings')->group(function () {
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

        Route::match(['get', 'post'], 'academy-profile', [SettingsController::class, 'academyProfile'])->name('settings.academy-profile');

        Route::prefix('users')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('user.index');
            Route::get('data', [UserController::class, 'data'])->name('user.data');
            Route::get('add', [UserController::class, 'editor'])->name('user.add');
            Route::get('edit/{id}', [UserController::class, 'editor'])->name('user.edit');
            Route::get('duplicate/{id}', [UserController::class, 'duplicate'])->name('user.duplicate');
            Route::post('save', [UserController::class, 'save'])->name('user.save');
            Route::post('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
            Route::get('detail/{id}', [UserController::class, 'detail'])->name('user.detail');
        });
    });
});

require_once __DIR__ . '/api.php';
require_once __DIR__ . '/auth.php';

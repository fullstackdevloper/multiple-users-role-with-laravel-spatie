<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::resource('dashboard', DashboardController::class);

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['user_permissions'])->group(function () {
        Route::prefix('user')->name('users.')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('list');
            Route::get('add/user', [UserController::class, 'addUser'])->name('add');
            Route::post('create/user', [UserController::class, 'create'])->name('create');
            Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        });

        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('', [RolesController::class, 'index'])->name('list');
            Route::get('edit/{role}', [RolesController::class, 'edit'])->name('edit');
            Route::patch('{role}', [RolesController::class, 'update'])->name('update');
        });

        Route::prefix('permission')->name('permission.')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('list');
            Route::post('', [PermissionController::class, 'store'])->name('store');
            Route::get('add', [PermissionController::class, 'create'])->name('create');
            Route::get('edit/{permission}', [PermissionController::class, 'edit'])->name('edit');
            Route::patch('{permission}', [PermissionController::class, 'update'])->name('update');
            Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';

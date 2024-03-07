<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostsController;
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

        Route::prefix('post')->name('post.')->group(function (){
            Route::get('',[PostsController::class,'index'])->name('list');
            Route::get('create/post', [PostsController::class, 'create'])->name('create');
            Route::post('add', [PostsController::class, 'add'])->name('store');
            Route::get('edit/{post}', [PostsController::class, 'edit'])->name('edit');
            Route::post('update/{post}', [PostsController::class, 'update'])->name('update');
            Route::delete('destroy/{post}', [PostsController::class, 'destroy'])->name('destroy');

        });


        Route::get('roles', [RolesController::class, 'index'])->name('roles.list');
        Route::resource('roles', RolesController::class)->except(['index' , 'show']);
        
        Route::get('permission', [PermissionController::class, 'index'])->name('permission.list');
        Route::resource('permission', PermissionController::class)->except('index');
    });
});

require __DIR__ . '/auth.php';

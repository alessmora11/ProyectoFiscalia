<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/usuario', [UserController::class,'index'])->name('users');

Route::get('/usuario/crear', [UserController::class,'create'])->name('users.create');
Route::post('/usuario/store', [UserController::class,'store'])->name('users.store');

Route::get('/usuario/editar/{id}', [UserController::class,'edit'])->name('users.edit');
Route::post('/usuario/modificar/{id}', [UserController::class,'update'])->name('users.update');

Route::get('/usuario/eliminar/{id}', [UserController::class, 'destroy'])->name('users.destroy');



Route::get('/rol', [RoleController::class,'index'])->name('roles');

Route::get('/rol/crear', [RoleController::class,'create'])->name('roles.create');
Route::post('/rol/store', [RoleController::class,'store'])->name('roles.store');

Route::get('/rol/editar/{id}', [RoleController::class,'edit'])->name('roles.edit');
Route::post('/rol/modificar/{id}', [RoleController::class,'update'])->name('roles.update');

Route::get('/rol/eliminar/{id}', [RoleController::class,'destroy'])->name('roles.destroy');

require __DIR__.'/auth.php';

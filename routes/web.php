<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::resource('posts', PostController::class)->only('show');
Route::get('/author/{user}', [UserController::class, 'show'])->name('users.show');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [UserController::class, 'edit'])->name('users.edit');
	Route::patch('/profile', [UserController::class, 'update'])->name('users.update');
	Route::delete('/profile', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/author/{id}', [UserController::class, 'show'])->name('users.show');

Route::middleware('guest')->group(function () {
	Route::get('register', [RegisterController::class, 'create'])->name('register');
	Route::post('register', [RegisterController::class, 'store']);
	Route::get('login', [LoginController::class, 'create'])->name('login');
	Route::post('login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
	Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

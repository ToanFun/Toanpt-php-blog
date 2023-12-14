<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
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
	Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->middleware('guest')->name('password.request');
  Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
  Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
  Route::post('reset-password', [ResetPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
	Route::get('/profile', [UserController::class, 'edit'])->name('users.edit');
	Route::patch('/profile', [UserController::class, 'update'])->name('users.update');
	Route::delete('/profile', [UserController::class, 'destroy'])->name('users.destroy');
	Route::get('verify-email', [VerificationController::class, 'notice'])->name('verification.notice');
  Route::get('verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
  Route::post('email/verification-notification', [VerificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
  Route::get('confirm-password', [ConfirmPasswordController::class, 'show'])->name('password.confirm');
  Route::post('confirm-password', [ConfirmPasswordController::class, 'store']);
  Route::put('password', [PasswordController::class, 'update'])->name('password.update');
	Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

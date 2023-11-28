<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PaymentsAdminController;

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

Route::get('/admin', [AuthController::class, 'index']);
Route::post('/admin', [AuthController::class, 'login'])->name('login');
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::get('/', [AuthController::class, 'index_public']);
Route::post('/', [AuthController::class, 'login_public'])->name('public.login');
Route::post('/logout', [AuthController::class, 'logout_public']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [PaymentsAdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard/approve/{id}', [PaymentsAdminController::class, 'payment_approve'])->name('admin.approve');
});

Route::middleware(['auth', 'public'])->group(function () {
    Route::get('/dashboard', [PaymentsController::class, 'index'])->name('public.dashboard');
    Route::post('/dashboard/payment_add', [PaymentsController::class, 'payment_add'])->name('public.payment_add');
});

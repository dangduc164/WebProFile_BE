<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportPdfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});



Route::group(['prefix' => 'admin'], function () {
    Route::post('/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('upload-avatar');
    Route::get('/{id}/info-user', [ProfileController::class, 'getInfo'])->name('info-user');
    Route::put('/{id}/createOrUpdate', [ProfileController::class, 'createOrUpdate'])->name('createOrUpdate');
});


Route::put('/generate-pdf', [ExportPdfController::class, 'generatePdf'])->name('generate-pdf');

Route::get('/{id}/info-customer', [ProfileController::class, 'getInforCustomer'])->name('info-customer');


<?php

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;

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

// Route::middleware('auth:sanctum')->group(function () {

// });

Route::post('/registerVerif', [AuthController::class, 'registerVerif']);
Route::put('/register/{token}', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgotPassword', [ResetPasswordController::class, 'forgotPassword']);
Route::put('/resetPassword/{token}', [ResetPasswordController::class, 'resetPassword']);
Route::get('/getPengguna', function () {
    $pengguna = Pengguna::all();
    return $pengguna;
});

<?php

use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PostinganController;
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
Route::put('/editProfile', [PenggunaController::class, 'editProfile'])->middleware(['auth:sanctum']);
Route::post('/addTeman', [PenggunaController::class, 'addTeman'])->middleware((['auth:sanctum']));
Route::get('/showTeman', [PenggunaController::class, 'showTeman'])->middleware((['auth:sanctum']));
Route::post('/addPostingan', [PostinganController::class, 'addPostingan'])->middleware((['auth:sanctum']));
Route::delete('/delPostingan/{postingan}', [PostinganController::class, 'delPostingan'])->middleware((['auth:sanctum']));
Route::post('/commentPostingan/{idPostingan}', [PostinganController::class, 'commentPostingan'])->middleware((['auth:sanctum']));
Route::delete('/delCommentPostingan/{idComment}', [PostinganController::class, 'delCommentPostingan'])->middleware((['auth:sanctum']));
Route::post('/likePostingan/{idPostingan}', [PostinganController::class, 'likePostingan'])->middleware((['auth:sanctum']));
Route::get('/showPostinganTeman', [PostinganController::class, 'showPostinganTeman'])->middleware((['auth:sanctum']));
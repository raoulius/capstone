<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AttendanceController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::post('/aspirasi',[AspirasiController::class, 'createAspirasi']);
Route::get('/aspirasi',[AspirasiController::class, 'getAspirasi']);

Route::post('/register', [AuthController::class, 'createAccount']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.record');
Route::get('/attendance/{rapatId}', [AttendanceController::class, 'getAttendanceForRapat'])->middleware(['web', 'auth'])->name('attendance.get-detail');
// Route::prefix('auth')->group(function () {
    
// })
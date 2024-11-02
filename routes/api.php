<?php

use App\Http\Controllers\Api\SensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/sensors', [SensorController::class, 'index']);
Route::post('/sensors', [SensorController::class, 'store']);
Route::put('/sensors/{id}', [SensorController::class, 'update']);
Route::delete('/sensors/{id}', [SensorController::class, 'delete']);

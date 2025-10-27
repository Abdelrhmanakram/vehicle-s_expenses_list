<?php

use App\Http\Controllers\VehicleExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('throttle:5,1') 
    ->get('/vehicle-expenses', [VehicleExpenseController::class, 'index']);

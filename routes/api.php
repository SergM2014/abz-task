<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employee/search', [EmployeeController::class, 'search'])
    ->name('api.employees.search');
    Route::get('employee/leader/{leaderId}', [EmployeeController::class, 'leader'])
    ->name('api.employees.search');
Route::post('image/store', [ImageController::class, 'store'])->name('image.store');
Route::post('image/rotate', [ImageController::class, 'rotate'])->name('image.rotate');
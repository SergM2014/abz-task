<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PositionController;

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
Route::get('employee/search/leaders', [EmployeeController::class, 'searchLeaders'])
    ->name('api.employees.search.leaders');
Route::get('employee/leader', [EmployeeController::class, 'getLeader'])
    ->name('api.employees.search');
Route::get('employee/subordinates', [EmployeeController::class, 'getSubordinates'])
    ->name('api.employees.subordinates');


Route::post('image/store', [ImageController::class, 'store'])->name('image.store');
Route::post('image/rotate', [ImageController::class, 'rotate'])->name('image.rotate');

Route::get('position/search', [PositionController::class, 'search'])
    ->name('api.positions.search');
Route::get('position/supreme', [PositionController::class, 'getSupremePosition'])
    ->name('api.positions.supreme');
Route::post('position/supremes', [PositionController::class, 'getSupremePositions'])
    ->name('api.positions.supremes');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PositionController;

Route::middleware(['auth'])->group(function () {

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

    Route::get('position/supreme', [PositionController::class, 'getSupremePosition'])
        ->name('api.positions.supreme');
    Route::post('position/supremes', [PositionController::class, 'getSupremePositions'])
        ->name('api.positions.supremes');
    Route::get('position/subpositions', [PositionController::class, 'getSubPositions'])
        ->name('api.positions.subpositions');
    Route::get('position/employees', [PositionController::class, 'getEmployees'])
        ->name('api.positions.employees');
}); 
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::prefix('admin')->group(function () {
    Route::resource('employees', EmployeeController::class);

    Route::get('/employee/delete', [ EmployeeController::class, 'delete'] )->name('employees.delete');

    Route::get('/leader/change', [ EmployeeController::class, 'getLeaderToChange'] )->name('employees.changeLeaderForm');

    Route::post('/leader/change', [ EmployeeController::class, 'changeLeader'])->name('employees.leader.change');
    
    Route::get('/positions/delete', [PositionController::class, 'delete']);
    
    Route::resource('positions', PositionController::class);
});  
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ComputerController;
use App\Http\Controllers\CyberControlController;

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

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');
Route::get('/bitacora', [CyberControlController::class, 'bitacora'])->middleware('can:admin.bitacora')->name('admin.bitacora');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('/roles', RoleController::class)->names('admin.roles');
    Route::resource('/users', UserController::class)->names('admin.users');
    Route::resource('/computers', ComputerController::class)->names('admin.computers');
});


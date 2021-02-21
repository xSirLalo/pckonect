<?php

use App\Http\Controllers\Admin\ComputerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/users/datatables', [UserController::class, 'datatable'])->name('admin.users.datatable');
Route::resource('users', UserController::class)->names('admin.users');

Route::resource('computers', ComputerController::class)->names('admin.computers');

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// DB::listen(function ($query) {
// 	echo "<pre>{$query->sql}</pre>";
// });

Route::get('/', function () {
	return view('welcome');
});

// if (App::environment('local', 'staging')) {
//     Route::get('/info', function() {
//     return phpinfo();
// });
// }

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cyber', [App\Http\Controllers\CyberControlController::class, 'index'])->middleware('can:web.cyber.index')->name('cyber.index');
Route::get('/cyber/select/{computer}', [App\Http\Controllers\CyberControlController::class, 'select'])->middleware('can:web.cyber.select')->name('cyber.select');
//Route::get('/cgi-bin/socket.cgi', function () { exec('cgi-bin/socket.cgi'); })->name('cyber.socket');
Route::post('/cyber', [App\Http\Controllers\CyberControlController::class, 'store'])->middleware('can:web.cyber.store')->name('cyber.store');

Auth::routes();

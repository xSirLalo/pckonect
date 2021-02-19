<?php

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

Route::get('/', function () {
    return view('welcome');
});

// if (App::environment('local', 'staging')) {
//     Route::get('/info', function() {
//     return phpinfo();
// });
// }

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cyber', [App\Http\Controllers\HomeController::class, 'cyber'])->name('cyber');
Route::get('/cyber/select/{computer}', [App\Http\Controllers\HomeController::class, 'select'])->name('cyber.select');
Route::post('/cyber', [App\Http\Controllers\CyberControlController::class, 'store'])->name('cyber.store');

Auth::routes();

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ormLoginController;

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

Route::get('/login', function () {
    return view('auth.ormlogin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/orm-login', [App\Http\Controllers\ormLoginController::class, 'login'])->name('ormlogin');

/* show Dashboard Page */
Route::get('/', function () {
    return view('ormDashboard');
});

/* show Inventory Page */
Route::get('/inventory', function () {
    return view('ormInventory');
});

/* show Transaction Page */
Route::get('/transaction', function () {
    return view('ormTransaction');
});

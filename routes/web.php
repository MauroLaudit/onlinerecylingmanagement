<?php
use Illuminate\Support\Facades\Routes;

use App\Http\Controllers\ormLoginController;
use App\Http\Controllers\ormUserController;
use App\Http\Controllers\ormProfileController;
use App\Http\Controllers\ormInventoryController;
use App\Http\Controllers\ormTransactionController;
use All\Models\User;
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

    return view('auth.ormLogin');
});

Route::get('/login', [ormLoginController::class, 'index'])->name('ormLogin');
Route::post('custom-login', [ormLoginController::class, 'userLogin'])->name('login.user'); 
Route::get('signout', [ormLoginController::class, 'signOut'])->name('signout');

Route::post('update_img', [ormProfileController::class, 'updatePicture'])->name('PictureUpdate');

Route::resource('register', ormUserController::class);

Route::group([ 'middleware' => ['auth']], function () {
    Route::get('/', [ormLoginController::class, 'dashboard'])->name('dashboard'); /* Show Dashboard */

    Route::resource('recyclable', ormInventoryController::class);

    Route::get('/inventory', [ormInventoryController::class, 'index'])->name('inventory'); /* show Inventory Page */

    Route::resource('client_transactions', ormTransactionController::class);

    Route::get('/transaction', [ormTransactionController::class, 'index'])->name('transaction'); //show Transaction Page
    Route::get('stocks', [ormTransactionController::class, 'getStocks'])->name('stockItems');
    Route::get('fetchStocks', [ormTransactionController::class, 'fetchStocksInfo'])->name('fetchItems');
    Route::get('orderList', [ormTransactionController::class, 'fetchOrderList'])->name('getOrders');


    Route::get('forecasting', function () {
        return view('ormForecasting');
    });
});
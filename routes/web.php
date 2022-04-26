<?php
use Illuminate\Support\Facades\Routes;

use App\Http\Controllers\ormLoginController;
use App\Http\Controllers\ormUserController;
use App\Http\Controllers\ormProfileController;
use App\Http\Controllers\ormInventoryController;
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

    Route::get('/transaction', function () { return view('ormTransaction'); }); //show Transaction Page
});
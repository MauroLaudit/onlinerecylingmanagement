<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ormLoginController;
use App\Http\Controllers\ormUserController;


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
Auth::routes();

Route::get('/', [ormLoginController::class, 'dashboard'])->name('dashboard'); 
Route::get('/login', [ormLoginController::class, 'index'])->name('ormLogin');
Route::post('custom-login', [ormLoginController::class, 'userLogin'])->name('login.user'); 
/* Route::get('/registration', [ormLoginController::class, 'registration'])->name('ormRegistration');
Route::post('/custom-registration', [ormLoginController::class, 'userRegistration'])->name('register.user'); */
Route::get('signout', [ormLoginController::class, 'signOut'])->name('signout');

Route::resource('register', ormUserController::class);

/* show Login Page */
/* Route::get('/orm-login', [App\Http\Controllers\ormLoginController::class, 'login'])->name('ormlogin'); */

/* show Dashboard Page */
/* Route::get('/', function () {
    return view('ormDashboard');
}); */

/* show Inventory Page */
Route::get('/inventory', function () {
    return view('ormInventory');
});

/* show Transaction Page */
Route::get('/transaction', function () {
    return view('ormTransaction');
});



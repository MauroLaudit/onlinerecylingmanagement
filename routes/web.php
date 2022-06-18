<?php
use Illuminate\Support\Facades\Routes;

use App\Http\Controllers\ormLoginController;
use App\Http\Controllers\ormUserController;
use App\Http\Controllers\ormProfileController;
use App\Http\Controllers\ormInventoryController;
use App\Http\Controllers\ormTransactionController;
use App\Http\Controllers\ormForecastingController;
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

    Route::resource('forecast', ormForecastingController::class);

    Route::get('forecasting', [ormForecastingController::class, 'index'])->name('forecasting');
    Route::get('forecasting-supply', [ormForecastingController::class, 'indexSupply'])->name('forecasting-supply');
    Route::get('forecasting-demand', [ormForecastingController::class, 'indexDemand'])->name('forecasting-demand');
    Route::get('forecasting-revenue', [ormForecastingController::class, 'indexRevenue'])->name('forecasting-revenue');

    //----FETCH AND FORECAST SUPPLY DATA----//
    Route::get('supply_search', [ormForecastingController::class, 'forecastSupply_data'])->name('supply');
    Route::get('fetchSupply_year', [ormForecastingController::class, 'yearsSupplyRecord'])->name('yearSupplyRecords');
    Route::get('fetchSupply_month', [ormForecastingController::class, 'monthsSupplyRecord'])->name('monthSupplyRecords');
    Route::get('fetch_totalSupply', [ormForecastingController::class, 'totalSupply'])->name('monthTotalSupply');

    //----FETCH RECORDS FOR ORDER IN YEAR AND MONTHS----//
    Route::get('fetchOrder_year', [ormForecastingController::class, 'yearsOrderRecord'])->name('yearOrderRecords');
    Route::get('fetchOrder_month', [ormForecastingController::class, 'monthsOrderRecord'])->name('monthOrderRecords');

    //----FORECAST DEMAND DATA----//
    Route::get('demand_search', [ormForecastingController::class, 'forecastDemand_data'])->name('demand');
    Route::get('fetch_totalDemand', [ormForecastingController::class, 'totalDemand'])->name('monthTotalDemand');

    //----FORECAST REVENUE DATA----//
    Route::get('revenue_search', [ormForecastingController::class, 'forecastRevenue_data'])->name('revenue');
    Route::get('fetch_totalRevenue', [ormForecastingController::class, 'totalRevenue'])->name('monthTotalRevenue');
});
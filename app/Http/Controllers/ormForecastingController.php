<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\StockInventory;
use App\Models\Orders;
use App\Models\Forecasting;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class ormForecastingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthly_sales = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->get();

        dd($monthly_sales);
        return view('ormForecasting');
    }

    public function monthly_supply()
    {
        $paper_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totAmount'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'PPR%')
            ->get();
        $plastic_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totAmount'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'PSC%')
            ->get();
        $metal_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totAmount'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'MTL%')
            ->get();
        $glass_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totAmount'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'GLS%')
            ->get();
    }

    public function monthly_revenue(){
        $paper_totRevenue = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Paper')
            ->get();
        $plastic_totRevenue = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Plastic')
            ->get();
        $metal_totRevenue = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Metal')
            ->get();
        $glass_totRevenue = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Glass')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

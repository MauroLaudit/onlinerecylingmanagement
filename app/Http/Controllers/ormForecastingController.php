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
use Carbon\Carbon;

class ormForecastingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paper_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'PPR%')
            ->get();

        //dd($paper_totSupply);
        return view('ormForecasting');
    }

    public function forecastSupply_data(Request $request){
        $input_category = $request->all();
        $category = $input_category;
        if($input_category['input_category'] == "Paper"){
            $category = 'PPR';
        }else if($input_category['input_category'] == "Plastic"){
            $category = 'PSC';
        }else if($input_category['input_category'] == "Metal"){
            $category = 'MTL';
        }else if($input_category['input_category'] == "Glass"){
            $category = 'GLS';
        }
        

        $paper_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', $category.'%')
            ->get();

        //dd(count($paper_totSupply));

        $monthSupply = "";
        $monSupplyValue = 0;
        $supLoop = 0;
        for($i = 1; $i<=12; $i++){
            
            if($i == 1){
                $monthSupply = "Jan";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 2){
                $monthSupply = "Feb";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 3){
                $monthSupply = "Mar";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 4){
                $monthSupply = "Apr";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 5){
                $monthSupply = "May";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 6){
                $monthSupply = "Jun";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 7){
                $monthSupply = "Jul";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 8){
                $monthSupply = "Aug";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 9){
                $monthSupply = "Sep";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 10){
                $monthSupply = "Oct";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 11){
                $monthSupply = "Nov";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 12){
                $monthSupply = "Dec";
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }

            $dataSupply[] = array(
                "monthData" => $monthSupply,
                "supplyValue" => $monSupplyValue
            );
        }
        
        return response()->json($dataSupply);
    }

    public function monthly_supply(){
        $paper_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'PPR%')
            ->get();
        $plastic_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'PSC%')
            ->get();
        $metal_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'MTL%')
            ->get();
        $glass_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', 'GLS%')
            ->get();
    }

    public function monthly_demand(){
        $paper_totDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(quantity) as total_demand'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Paper')
            ->get();
        $plastic_totDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(quantity) as total_demand'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Plastic')
            ->get();
        $metal_totDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(quantity) as total_demand'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Metal')
            ->get();
        $glass_totDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(quantity) as total_demand'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', 'Glass')
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

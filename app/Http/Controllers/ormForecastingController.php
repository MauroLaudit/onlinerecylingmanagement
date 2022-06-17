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
        return view('ormForecasting');
    }

    public function indexSupply()
    {
        return view('forecasting_views.supply_forecast');
    }

    public function indexDemand()
    {
        return view('forecasting_views.demand_forecast');
    }

    public function indexRevenue()
    {
        return view('forecasting_views.revenue_forecast');
    }

    public function yearsRecord(Request $request){
        $input_category = $request->all();
        
        $category = $input_category;
        if($input_category['category'] == "Paper"){
            $category = 'PPR';
        }else if($input_category['category'] == "Plastic"){
            $category = 'PSC';
        }else if($input_category['category'] == "Metal"){
            $category = 'MTL';
        }else if($input_category['category'] == "Glass"){
            $category = 'GLS';
        }else{
            $category = "";
        }
        
        $yearsList = [];

        $dataSupplies = DB::table('inventory')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->groupby('year')
            ->where('stock_id', 'like', $category.'%')
            ->get();
        
        if (count($dataSupplies) > 0) {

            foreach ($dataSupplies as $supplyYear) {
                $yearsList[] = array(
                    "id" => $supplyYear->year,
                    "text" => $supplyYear->year,
                );
            }
        }
        return response()->json($yearsList);
    }

    public function monthsRecord(Request $request){
        $input_category = $request->all();
        $category = $input_category;
        if($input_category['category'] == "Paper"){
            $category = 'PPR';
        }else if($input_category['category'] == "Plastic"){
            $category = 'PSC';
        }else if($input_category['category'] == "Metal"){
            $category = 'MTL';
        }else if($input_category['category'] == "Glass"){
            $category = 'GLS';
        }else{
            $category = "";
        }
        
        $monthsList = [];

        $dataSupplies = DB::table('inventory')
            ->select(DB::raw('MONTH(created_at) as month'))
            ->groupby('month')
            ->whereYear('created_at','=',  $input_category['year'])
            ->where('stock_id', 'like', $category.'%')
            ->get();
        
        if (count($dataSupplies) > 0) {

            foreach ($dataSupplies as $supplyMonth) {
                $wordMonth = "";
                if($supplyMonth->month == 1){
                    $wordMonth = "Jan";
                }else if($supplyMonth->month == 2){
                    $wordMonth = "Feb";
                }
                else if($supplyMonth->month == 3){
                    $wordMonth = "Mar";
                }
                else if($supplyMonth->month == 4){
                    $wordMonth = "Apr";
                }
                else if($supplyMonth->month == 5){
                    $wordMonth = "May";
                }
                else if($supplyMonth->month == 6){
                    $wordMonth = "Jun";
                }
                else if($supplyMonth->month == 7){
                    $wordMonth = "Jul";
                }
                else if($supplyMonth->month == 8){
                    $wordMonth = "Aug";
                }
                else if($supplyMonth->month == 9){
                    $wordMonth = "Sep";
                }
                else if($supplyMonth->month == 10){
                    $wordMonth = "Oct";
                }
                else if($supplyMonth->month == 11){
                    $wordMonth = "Nov";
                }
                else if($supplyMonth->month == 12){
                    $wordMonth = "Dec";
                }
                $monthsList[] = array(
                    "id" => $wordMonth,
                    "text" => $wordMonth,
                );
            }
        }
        return response()->json($monthsList);
    }

    public function totalSupply(Request $request){
        $input_category = $request->all();
        $category = $input_category;
        if($input_category['category'] == "Paper"){
            $category = 'PPR';
        }else if($input_category['category'] == "Plastic"){
            $category = 'PSC';
        }else if($input_category['category'] == "Metal"){
            $category = 'MTL';
        }else if($input_category['category'] == "Glass"){
            $category = 'GLS';
        }else{
            $category = "";
        }

        /* Check If What Month In Number */
        $numMonth = 0;
        if($input_category['month'] == "Jan"){
            $numMonth = 1;
        }else if($input_category['month'] == "Feb"){
            $numMonth = 2;
        }
        else if($input_category['month'] == "Mar"){
            $numMonth = 3;
        }
        else if($input_category['month'] == "Apr"){
            $numMonth = 4;
        }
        else if($input_category['month'] == "May"){
            $numMonth = 5;
        }
        else if($input_category['month'] == "Jun"){
            $numMonth = 6;
        }
        else if($input_category['month'] == "Jul"){
            $numMonth = 7;
        }
        else if($input_category['month'] == "Aug"){
            $numMonth = 8;
        }
        else if($input_category['month'] == "Sep"){
            $numMonth = 9;
        }
        else if($input_category['month'] == "Oct"){
            $numMonth = 10;
        }
        else if($input_category['month'] == "Nov"){
            $numMonth = 11;
        }
        else if($input_category['month'] == "Dec"){
            $numMonth = 12;
        }
        
        $dataSupplies = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'))
            ->whereMonth('created_at','=',  $numMonth)
            ->whereYear('created_at','=',  $input_category['year'])
            ->where('stock_id', 'like', $category.'%')
            ->get();
        //dd( $dataSupplies);
        return response()->json($dataSupplies);
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

        $forecast_totSupply = DB::table('forecasting')
            ->select(DB::raw('forecast_supply as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('totSupply','year','month')
            ->where('category', '=', $input_category['input_category'])
            ->get();

        //dd(count($paper_totSupply));

        $monthSupply = "";
        $monSupplyValue = 0;
        $forecastSupplyValue = 0;
        $foreloop = 0;
        $supLoop = 0;
        for($i = 1; $i<=12; $i++){
            
            if($i == 1){
                $monthSupply = "Jan";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 2){
                $monthSupply = "Feb";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 3){
                $monthSupply = "Mar";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 4){
                $monthSupply = "Apr";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 5){
                $monthSupply = "May";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 6){
                $monthSupply = "Jun";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 7){
                $monthSupply = "Jul";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 8){
                $monthSupply = "Aug";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 9){
                $monthSupply = "Sep";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 10){
                $monthSupply = "Oct";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 11){
                $monthSupply = "Nov";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }else if($i == 12){
                $monthSupply = "Dec";
                //condition value for Monthly Supply------------
                if($supLoop >= count($paper_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $paper_totSupply[$supLoop]->month){
                    $monSupplyValue = $paper_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
                //condition value for Forecast Supply------------
                if($foreloop >= count($forecast_totSupply)){
                    $forecastSupplyValue = '';
                }else if($i == $forecast_totSupply[$foreloop]->month){
                    $forecastSupplyValue = $forecast_totSupply[$foreloop]->totSupply;
                    $foreloop+=1;
                }else{
                    $forecastSupplyValue = 0;
                }
            }

            $dataSupply[] = array(
                "monthData" => $monthSupply,
                "supplyValue" => $monSupplyValue,
                "forecastSupply" => $forecastSupplyValue
            );
        }
        
        return response()->json($dataSupply);
    }

    /* public function forecast_data(Request $request){
        $input_category = $request->all();
        
        $forecast_totSupply = DB::table('forecasting')
            ->select(DB::raw('forecast_supply as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('totSupply','year','month')
            ->where('category', '=', $input_category['category'])
            ->get();

        //dd($forecast_totSupply);

        $monthSupply = "";
        $monSupplyValue = 0;
        $supLoop = 0;
        for($i = 1; $i<=12; $i++){
            
            if($i == 1){
                $monthSupply = "Jan";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 2){
                $monthSupply = "Feb";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 3){
                $monthSupply = "Mar";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 4){
                $monthSupply = "Apr";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 5){
                $monthSupply = "May";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 6){
                $monthSupply = "Jun";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 7){
                $monthSupply = "Jul";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 8){
                $monthSupply = "Aug";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 9){
                $monthSupply = "Sep";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 10){
                $monthSupply = "Oct";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 11){
                $monthSupply = "Nov";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
                    $supLoop+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 12){
                $monthSupply = "Dec";
                if($supLoop >= count($forecast_totSupply)){
                    $monSupplyValue = '';
                }else if($i == $forecast_totSupply[$supLoop]->month){
                    $monSupplyValue = $forecast_totSupply[$supLoop]->totSupply;
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
    } */

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
        return view('ormForecasting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supply = $request['totalSupply'];
        $totSup = 0;
        //dd($supply);
        for($i = 0; $i < count($request['totalSupply']); $i++){
            $totSup += (int)$supply[$i]; 
        }//dd($totSup/count($request['totalSupply']));

        $avg = $totSup/count($request['totalSupply']);

        $forecast = Forecasting::create([
            'category' => $request['modal_category'],
            'forecast_supply' => $avg,
        ]); 
        event(new Registered($forecast));

        return redirect()->intended(route('forecasting'))->with('success', 'Forecast Successfully!');

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

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
use Illuminate\Support\Facades\Route;
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

    //-----------MONTHLY SUPPLY FORECAST--------------------//
    public function yearsSupplyRecord(Request $request){
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

    public function monthsSupplyRecord(Request $request){
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
        $year = 0;
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
        
        if($input_category['year'] == ""){
            $year = Carbon::now()->format('Y');
        }
        else{
            $year = $input_category['year'];
        }

        $paper_totSupply = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->where('stock_id', 'like', $category.'%')
            ->whereYear('created_at', '=', $year)
            ->get();

        $forecast_totSupply = DB::table('forecasting')
            ->select(DB::raw('forecast_value as totSupply'), DB::raw('YEAR(forecast_month) as year, MONTH(forecast_month) as month'))
            ->groupby('totSupply','year','month')
            ->where('category', '=', $input_category['input_category'])
            ->where('forecast_category', '=','Supply')
            ->whereYear('forecast_month', '=', $year)
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
    //-----------END MONTHLY SUPPLY FORECAST--------------------//

    //-----------MONTHLY DEMAND FORECAST--------------------//
    public function yearsOrderRecord(Request $request){
        $input_category = $request->all();
        
        $yearsList = [];

        $dataDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('YEAR(company_orders.created_at) as year'))
            ->groupby('year')
            ->where('category', '=', $input_category['category'])
            ->get();
        
        if (count($dataDemand) > 0) {

            foreach ($dataDemand as $demandYear) {
                $yearsList[] = array(
                    "id" => $demandYear->year,
                    "text" => $demandYear->year,
                );
            }
        }
        return response()->json($yearsList);
    }

    public function monthsOrderRecord(Request $request){
        $input_category = $request->all();
        
        $monthsList = [];

        $dataDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('MONTH(company_orders.created_at) as month'))
            ->groupby('month')
            ->whereYear('company_orders.created_at','=',  $input_category['year'])
            ->where('category', '=', $input_category['category'])
            ->get();
        
        if (count($dataDemand) > 0) {

            foreach ($dataDemand as $demandMonth) {
                $wordMonth = "";
                if($demandMonth->month == 1){
                    $wordMonth = "Jan";
                }else if($demandMonth->month == 2){
                    $wordMonth = "Feb";
                }
                else if($demandMonth->month == 3){
                    $wordMonth = "Mar";
                }
                else if($demandMonth->month == 4){
                    $wordMonth = "Apr";
                }
                else if($demandMonth->month == 5){
                    $wordMonth = "May";
                }
                else if($demandMonth->month == 6){
                    $wordMonth = "Jun";
                }
                else if($demandMonth->month == 7){
                    $wordMonth = "Jul";
                }
                else if($demandMonth->month == 8){
                    $wordMonth = "Aug";
                }
                else if($demandMonth->month == 9){
                    $wordMonth = "Sep";
                }
                else if($demandMonth->month == 10){
                    $wordMonth = "Oct";
                }
                else if($demandMonth->month == 11){
                    $wordMonth = "Nov";
                }
                else if($demandMonth->month == 12){
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

    public function totalDemand(Request $request){
        $input_category = $request->all();

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
        
        $dataDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(quantity) as totDemand'))
            ->whereMonth('company_orders.created_at','=',  $numMonth)
            ->whereYear('company_orders.created_at','=',  $input_category['year'])
            ->where('category', '=', $input_category['category'])
            ->get();
        //dd( $dataSupplies);
        return response()->json($dataDemand);
    }

    public function forecastDemand_data(Request $request){
        $input_category = $request->all();
        $year = 0;
        
        if($input_category['year'] == ""){
            $year = Carbon::now()->format('Y');
        }
        else{
            $year = $input_category['year'];
        }

        $monthly_totDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(quantity) as total_demand'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', $input_category['input_category'])
            ->whereYear('company_orders.created_at', '=', $year)
            ->get();

        $forecast_totDemand = DB::table('forecasting')
            ->select(DB::raw('forecast_value as totDemand'), DB::raw('YEAR(forecast_month) as year, MONTH(forecast_month) as month'))
            ->groupby('totDemand','year','month')
            ->where('category', '=', $input_category['input_category'])
            ->where('forecast_category', '=','Demand')
            ->whereYear('forecast_month', '=', $year)
            ->get();

        //dd($forecast_totDemand);

        $monthDemand = "";
        $monDemandValue = 0;
        $forecastDemandValue = 0;
        $foreloop = 0;
        $supLoop = 0;
        for($i = 1; $i<=12; $i++){
            
            if($i == 1){
                $monthDemand = "Jan";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 2){
                $monthDemand = "Feb";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 3){
                $monthDemand = "Mar";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 4){
                $monthDemand = "Apr";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 5){
                $monthDemand = "May";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 6){
                $monthDemand = "Jun";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 7){
                $monthDemand = "Jul";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 8){
                $monthDemand = "Aug";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 9){
                $monthDemand = "Sep";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 10){
                $monthDemand = "Oct";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 11){
                $monthDemand = "Nov";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }else if($i == 12){
                $monthDemand = "Dec";
                //condition value for Monthly Demand------------
                if($supLoop >= count($monthly_totDemand)){
                    $monDemandValue = '';
                }else if($i == $monthly_totDemand[$supLoop]->month){
                    $monDemandValue = $monthly_totDemand[$supLoop]->total_demand;
                    $supLoop+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Forecast Demand------------
                if($foreloop >= count($forecast_totDemand)){
                    $forecastDemandValue = '';
                }else if($i == $forecast_totDemand[$foreloop]->month){
                    $forecastDemandValue = $forecast_totDemand[$foreloop]->totDemand;
                    $foreloop+=1;
                }else{
                    $forecastDemandValue = 0;
                }
            }

            $dataDemand[] = array(
                "monthData" => $monthDemand,
                "demandValue" => $monDemandValue,
                "forecastDemand" => $forecastDemandValue
            );
        }
        
        return response()->json($dataDemand);
    }
    //-----------END MONTHLY DEMAND FORECAST--------------------//

    //-----------MONTHLY REVENUE FORECAST--------------------//
    public function totalRevenue(Request $request){
        $input_category = $request->all();

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
        
        $dataDemand = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'))
            ->whereMonth('company_orders.created_at','=',  $numMonth)
            ->whereYear('company_orders.created_at','=',  $input_category['year'])
            ->where('category', '=', $input_category['category'])
            ->get();
        //dd( $dataSupplies);
        return response()->json($dataDemand);
    }

    public function forecastRevenue_data(Request $request){
        $input_category = $request->all();
        $year = 0;
        
        if($input_category['year'] == ""){
            $year = Carbon::now()->format('Y');
        }
        else{
            $year = $input_category['year'];
        }

        $monthly_totRevenue = DB::table('company_orders')
            ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
            ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
            ->select(DB::raw('SUM(total_price) as total_revenue'), DB::raw('YEAR(company_orders.created_at) as year, MONTH(company_orders.created_at) as month'))
            ->groupby('year','month')
            ->where('category', '=', $input_category['input_category'])
            ->whereYear('company_orders.created_at', '=', $year)
            ->get();

        $forecast_totRevenue = DB::table('forecasting')
            ->select(DB::raw('forecast_value as totRevenue'), DB::raw('YEAR(forecast_month) as year, MONTH(forecast_month) as month'))
            ->groupby('totRevenue','year','month')
            ->where('category', '=', $input_category['input_category'])
            ->where('forecast_category', '=','Revenue')
            ->whereYear('forecast_month', '=', $year)
            ->get();

        //dd($forecast_totRevenue);

        $monthRevenue = "";
        $monRevenueValue = 0;
        $forecastRevenueValue = 0;
        $foreloop = 0;
        $supLoop = 0;
        for($i = 1; $i<=12; $i++){
            
            if($i == 1){
                $monthRevenue = "Jan";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 2){
                $monthRevenue = "Feb";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 3){
                $monthRevenue = "Mar";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 4){
                $monthRevenue = "Apr";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 5){
                $monthRevenue = "May";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 6){
                $monthRevenue = "Jun";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 7){
                $monthRevenue = "Jul";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 8){
                $monthRevenue = "Aug";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 9){
                $monthRevenue = "Sep";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 10){
                $monthRevenue = "Oct";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 11){
                $monthRevenue = "Nov";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }else if($i == 12){
                $monthRevenue = "Dec";
                //condition value for Monthly Revenue------------
                if($supLoop >= count($monthly_totRevenue)){
                    $monRevenueValue = '';
                }else if($i == $monthly_totRevenue[$supLoop]->month){
                    $monRevenueValue = $monthly_totRevenue[$supLoop]->total_revenue;
                    $supLoop+=1;
                }else{
                    $monRevenueValue = 0;
                }
                //condition value for Forecast Revenue------------
                if($foreloop >= count($forecast_totRevenue)){
                    $forecastRevenueValue = '';
                }else if($i == $forecast_totRevenue[$foreloop]->month){
                    $forecastRevenueValue = $forecast_totRevenue[$foreloop]->totRevenue;
                    $foreloop+=1;
                }else{
                    $forecastRevenueValue = 0;
                }
            }

            $dataRevenue[] = array(
                "monthData" => $monthRevenue,
                "revenueValue" => $monRevenueValue,
                "forecastRevenue" => $forecastRevenueValue
            );
        }
        
        return response()->json($dataRevenue);
    }
    //-----------END MONTHLY REVENUE FORECAST--------------------//

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
            'forecast_category' => $request['forecast_type'],
            'category' => $request['modal_category'],
            'forecast_value' => $avg,
            'forecast_month' => $request['forecast_month'].-01,
        ]); 
        event(new Registered($forecast));

        if ($request['forecast_type'] == "Supply") {
            return redirect()->intended(route('forecasting-supply'))->with('success', 'Forecast Successfully!');
        }else if ($request['forecast_type'] == "Demand") {
            return redirect()->intended(route('forecasting-demand'))->with('success', 'Forecast Successfully!');
        }else if ($request['forecast_type'] == "Revenue") {
            return redirect()->intended(route('forecasting-revenue'))->with('success', 'Forecast Successfully!');
        }
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

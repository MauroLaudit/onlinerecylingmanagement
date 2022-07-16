<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\StockInventory;
use App\Models\Orders;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Route;
use DB;
use Carbon\Carbon;

class ormDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthly_catRevenue = DB::table('company_orders')
                ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
                ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
                ->select(DB::raw('SUM(total_price) as totCatRevenue'), DB::raw('stock_inventory.category as categories'))
                ->groupby('stock_inventory.category')
                ->whereMonth('company_orders.created_at', '=', 7)
                ->whereYear('company_orders.created_at', '=', 2022)
                ->get();

                dd($monthly_catRevenue);
        if(Auth::check()){
            return view('ormDashboard');
        }

        return redirect("login")->withErrors('You are not allowed to access');
        
    }

    public function forecastDashBoard(Request $request){
        $data = $request->all();

        $transactRecords = DB::table('transaction_company')
            ->join('company_orders', 'transaction_company.transaction_id', '=', 'company_orders.transaction_id')
            ->select('transaction_company.*', 'company_orders.quantity')
            ->select(DB::raw('SUM(company_orders.quantity) as totalDemand'), DB::raw('YEAR(transaction_company.created_at) as year, MONTH(transaction_company.created_at) as month'))
            ->groupby('year','month')
            ->whereYear('transaction_company.created_at', '=', $data['year'])
            ->get();

        $supplyRecords = DB::table('inventory')
            ->select(DB::raw('SUM(amount) as totSupply'), DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
            ->groupby('year','month')
            ->whereYear('created_at', '=', '2022')
            ->get();

        //dd(count($paper_totSupply));

        $monthValue = "";
        $monDemandValue = 0;
        $monSupplyValue = 0;
        $ctrD = 0;
        $ctrS = 0;
        for($i = 1; $i<=12; $i++){
            
            if($i == 1){
                $monthValue = "Jan";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 2){
                $monthValue = "Feb";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 3){
                $monthValue = "Mar";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 4){
                $monthValue = "Apr";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 5){
                $monthValue = "May";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 6){
                $monthValue = "Jun";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 7){
                $monthValue = "Jul";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 8){
                $monthValue = "Aug";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 9){
                $monthValue = "Sep";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 10){
                $monthValue = "Oct";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 11){
                $monthValue = "Nov";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }else if($i == 12){
                $monthValue = "Dec";
                //condition value for Monthly Demand------------
                if($ctrD >= count($transactRecords)){
                    $monDemandValue = '';
                }else if($i == $transactRecords[$ctrD]->month){
                    $monDemandValue = $transactRecords[$ctrD]->totalDemand;
                    $ctrD+=1;
                }else{
                    $monDemandValue = 0;
                }
                //condition value for Monthly Supply------------
                if($ctrS >= count($supplyRecords)){
                    $monSupplyValue = '';
                }else if($i == $supplyRecords[$ctrS]->month){
                    $monSupplyValue = $supplyRecords[$ctrS]->totSupply;
                    $ctrS+=1;
                }else{
                    $monSupplyValue = 0;
                }
            }

            $dataRecords[] = array(
                "monthData" => $monthValue,
                "dataDemand" => $monDemandValue,
                "dataSupply" => $monSupplyValue,
            );
        }
        
        return response()->json($dataRecords);
    }

    public function recordRevenue(Request $request){
        $data = $request->all();

        $yearRevenue = DB::table('transaction_company')
            ->join('company_orders', 'transaction_company.transaction_id', '=', 'company_orders.transaction_id')
            ->select('transaction_company.*', 'company_orders.total_price')
            ->select(DB::raw('SUM(company_orders.total_price) as totalRevenue'))
            ->whereYear('transaction_company.created_at', '=', $data['year'])
            ->get();

        $monthRevenue = DB::table('transaction_company')
            ->join('company_orders', 'transaction_company.transaction_id', '=', 'company_orders.transaction_id')
            ->select('transaction_company.*', 'company_orders.total_price')
            ->select(DB::raw('SUM(company_orders.total_price) as totalRevenue'))
            ->whereMonth('transaction_company.created_at', '=', $data['month'])
            ->whereYear('transaction_company.created_at', '=', $data['year'])
            ->get();
            
        $totMonthlyTransacts = DB::table('transaction_company')
            ->select(DB::raw('COUNT(*) as totTransact'))
            ->whereMonth('created_at', '=', $data['month'])
            ->whereYear('created_at', '=', $data['year'])
            ->get();

        $dataRecords[] = array(
            "yearRevenueValue" => $yearRevenue[0]->totalRevenue,
            "glassRevenue" => $monthRevenue[0]->totalRevenue,
            "monTotTransactions" => $totMonthlyTransacts[0]->totTransact,
        );

        return response()->json($dataRecords);
    }

    public function categorizeRevenue(Request $request){
        $data = $request->all();

        $monthRecords = DB::table('company_orders')
                ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'))
                ->groupby('year', 'month')
                ->whereYear('company_orders.created_at', '=', $data['year'])
                ->get();

        //dd($forecast_totRevenue);

        $monthRevenue = "";
        $glassRevenue = 0;
        $metalRevenue = 0;
        $paperRevenue = 0;
        $plasticRevenue = 0;
        $loop = 0;
        $ctr = 0;
        for($i = 1; $i<=12; $i++){
            $monthly_catRevenue = DB::table('company_orders')
                ->join('stock_inventory', 'company_orders.stock_id', '=', 'stock_inventory.id')
                ->select('company_orders.*', 'stock_inventory.category', 'stock_inventory.recyclable')
                ->select(DB::raw('SUM(total_price) as totCatRevenue'), DB::raw('stock_inventory.category as categories'))
                ->groupby('stock_inventory.category')
                ->whereMonth('company_orders.created_at', '=', $i)
                ->whereYear('company_orders.created_at', '=', $data['year'])
                ->get();
            
            if($i == 1){
                $monthRevenue = "Jan";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
            }else if($i == 2){
                $monthRevenue = "Feb";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 3){
                $monthRevenue = "Mar";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 4){
                $monthRevenue = "Apr";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 5){
                $monthRevenue = "May";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 6){
                $monthRevenue = "Jun";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 7){
                $monthRevenue = "Jul";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 8){
                $monthRevenue = "Aug";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 9){
                $monthRevenue = "Sep";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 10){
                $monthRevenue = "Oct";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 11){
                $monthRevenue = "Nov";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }else if($i == 12){
                $monthRevenue = "Dec";
                //condition value for Categorize Revenue------------
                if($ctr >= count($monthRecords)){
                    $glassRevenue = "";
                    $metalRevenue = "";
                    $paperRevenue = "";
                    $plasticRevenue = "";
                }else if($i == $monthRecords[$ctr]->month){
                    $glassRevenue = $monthly_catRevenue[$loop]->totCatRevenue;
                    $metalRevenue = $monthly_catRevenue[$loop+1]->totCatRevenue;
                    $paperRevenue = $monthly_catRevenue[$loop+2]->totCatRevenue;
                    $plasticRevenue = $monthly_catRevenue[$loop+3]->totCatRevenue;
                    $ctr+=1;
                }else{
                    $glassRevenue = 0;
                    $metalRevenue = 0;
                    $paperRevenue = 0;
                    $plasticRevenue = 0;
                }
                
            }
            $dataRevenue[] = array(
                "monthData" => $monthRevenue,
                "glassValue" => $glassRevenue,
                "metalValue" => $metalRevenue,
                "paperValue" => $paperRevenue,
                "plasticValue" => $plasticRevenue
            );
        }
        
        return response()->json($dataRevenue);
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

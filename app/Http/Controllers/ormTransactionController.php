<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Company;
use App\Models\Orders;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Response;
use DataTables;


class ormTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Company::all();
        return view('ormTransaction', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ormTransaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $client = Company::create([
            'transaction_id' => $request['transaction_id'],
            'company_name' => $request['company_name'],
            'client_name' => $request['client_name'],
            'address' => $request['address'],
            'contact_no' => $request['contact'],
        ]); 
        if ($client->save()){
            $id = $request['transaction_id'];
            $finalArray = array();    

            $commodity = $request['commodity'];
            $quantity = $request['quantity'];
            $tot_price = $request['tot_price'];
            $loop = 0;
            foreach($request['commodity'] as $orders => $items){                
                $orderItems = new Orders;
                $orderItems['transaction_id'] = $id;
                $orderItems['stock_id'] = $commodity[$loop];
                $orderItems['quantity'] = $quantity[$loop];
                $orderItems['total_price'] = $tot_price[$loop];
                $orderItems->save();
                $loop+=1;
            }
        }

        return redirect()->intended(route('transaction'))->with('success', 'Added Successfully!');
    }

    public function getStocks(Request $request)
    {
        $input = $request->all();

        if (!empty($input['query'])) {

            $data = Inventory::select(["id", "stock_id", "recyclable", "amount", "price"])
                ->where("recyclable", "LIKE", "%{$input['query']}%")
                ->get();
        } else {

            $data = Inventory::select(["id", "stock_id", "recyclable", "amount", "price"])
                ->get();
        }

        $recylables = [];

        if (count($data) > 0) {

            foreach ($data as $stocks) {
                $recylables[] = array(
                    "id" => $stocks->stock_id,
                    "text" => $stocks->recyclable,
                );
            }
        }
        return response()->json($recylables);
    }

    public function fetchStocksInfo(Request $request){
        $stock_id = $request->all();
        $stockItems = Inventory::select('price', 'amount')->where('stock_id','=', $stock_id)->get();
        return response()->json($stockItems);
    }

    public function fetchOrderList($transaction_id){
        $sec = Orders::select('transaction_id')->where('id', '=', $transaction_id)->get();
        $emp = Orders::whereIn('transaction_id', $sec)->get();
        return response()->json($emp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($transaction_id)
    {
        $sec = Company::select('transaction_id')->where('id', '=', $transaction_id)->get();
        $emp = Orders::whereIn('transaction_id', $sec)->get();
        return response()->json($emp);
        //return view('transaction_views.view_transacts', compact('emp'));
        //return dd($emp);

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

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

class ormTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::all();
        return view('ormTransaction')->with('inventory', $inventory);
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
        $client = Goodsreceiveheader::findorNew($request->id);
        $head->referencenumber=$request->referencenumber;
        $head->vendorid=$request->vendorid;
        $head->date=$request->date;
        $head->createdby=$request->createdby;
        if ($head->save()){
            $id = $head->id;
            foreach($request->itemid as $key =>$item_id){
                $data = array(
                                'goodsreceiveheader_id'=>$id,
                                'itemid'=>$request->itemid [$key],
                                'quantity'=>$request->quantity [$key],
                                'costprice'=>$request->costprice [$key],
                    );
                Goodsreceivedetail::insert($data);
            }
        }

        Session::flash('message','You have successfully create goods receive.');

        return redirect('goodsreceive/goodsreceiveheader_list');
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

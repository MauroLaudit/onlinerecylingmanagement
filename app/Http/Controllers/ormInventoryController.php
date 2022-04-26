<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ormInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::all();
        return view('ormInventory')->with('inventory', $inventory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ormInventory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rc_id' => 'required', 'string', 'unique:inventory',
            'rec_item' => 'required',
            'amount' => 'required', 'integer',
            'price' => 'required', 'decimal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors('Validation Error')->withInput();
        }

        $inventory = Inventory::create([
            'stock_id' => $request['rc_id'],
            'recyclable' => $request['rec_item'],
            'amount' => $request['amount'],
            'price' => $request['price'],
        ]); 
        event(new Registered($inventory));

        return redirect()->intended(route('inventory'))->with('success', 'Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        return view('ormInventory')->with($inventory, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('ormInventory')->with($inventory, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rc_id' => 'required', 'string', 'unique:inventory',
            'rec_item' => 'required',
            'amount' => 'required', 'integer',
            'price' => 'required', 'decimal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors('Validation Error')->withInput();
        }

        $inventory = array(
            'stock_id' => $request->rc_id,
            'recyclable' => $request->rec_item,
            'amount' => $request->amount,
            'price' => $request->price,
        ); 

        //echo "<pre>"; print_r($inventory); die; 

        Inventory::findOrFail($request->inventory_id)->update($inventory);
        return redirect()->route('recyclable.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $inventory)
    {
        $delete_inventory = Inventory::findOrFail($inventory->inventory_id);
        $delete_inventory->delete();
        return redirect()->route('recyclable.index')->with('success', 'Deleted Successfully.');
    }
}

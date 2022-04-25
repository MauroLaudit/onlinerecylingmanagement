<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ormInventory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ormInventory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory_views.add_inventory');
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
            'rc-id' => 'required', 'string', 'unique:inventory',
            'rec-item' => 'required',
            'amount' => 'required', 'integer',
            'price' => 'required', 'decimal',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors('Required field is empty')->withInput();
        }

        $inventory = User::create([
            'recyclable' => $request['fname'],
            'lname' => $request['lname'],
            'bdate' => $request['bdate'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'age' => $request['age'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->attachRole($request->role_id);  
        event(new Registered($user));

        return redirect()->intended(route('dashboard'))->with('success', 'Login Successfully!');
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

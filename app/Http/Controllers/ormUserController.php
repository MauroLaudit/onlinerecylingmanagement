<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ormUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.ormLogin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.ormRegistration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'fname' => ['required', 'regex:/^[a-z A-Z]+s/u'],
    //         'mname' => ['regex:/^[a-z A-Z]+s/u'],
    //         'lname' => ['required','regex:/^[a-z A-Z]+s/u'],
    //         'gender' => ['required','in:male,female'],
    //         'role' => ['required'],
    //         'email' => ['required','email','unique:users'],
    //         'password' => ['required','min:8','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
    //         'confirm_password' => ['required','same:password'],
    //         'upload_img' => ['required','file','max:1024'],
    //     ]);
        
    //     if ($validator->fails())
    //     {
    //         return redirect()->back()->withErrors('Required field is empty')->withInput();
    //     }
    //     $data= new Data();
    //     $data->fname=$request->get('fname');
    //     $data->mname=$request->get('mname');
    //     $data->lname=$request->get('lname');
    //     $data->gender=$request->get('gender');
    //     $data->role=$request->get('role');
    //     $data->email=$request->get('email');
    //     $data->password=$request->get('password');
    //     $data->upload_img=$request->get('upload_img');
    //     $data->save();
   
    //     return response()->json(['success'=>'Data is successfully added']);
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'gender' => 'required','in:male,female',
            'role' => 'required',
            'email' => 'required','email','unique:users',
            'password' => 'required','min:8',
            'confirm_password' => 'required','same:password',
            'upload_img' => 'required','file','max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors('Required field is empty')->withInput();
        }

        Auth::login($user = User::create([
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'lname' => $request['lname'],
            'gender' => $request['gender'],
            'role' => $request['role'],
            'email' => $request['email'],
            'password' => $request['password'],
            'confirm_password' => $request['confirm_password'],
            'upload_img' => $request['upload_img'],
        ]));
        //$user->attachRole($request->role);  
        event(new Registered($user));

        return redirect()->intended(route('ormLogin'))->with('success', 'Login Successfully!');
        
        
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

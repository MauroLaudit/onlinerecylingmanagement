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
use DB;

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

    public function userManagement()
    {
        $user = User::all();
        $modalClose = "";
        if(DB::table('users')->count() > 0){
            $modalClose = "d-block";
        }else if(DB::table('users')->count() == 0){
            $modalClose = "d-none";
        }
        return view('ormUserManagement')->with('user', $user)->with('modalClose', $modalClose);
    }

    public function userProfile()
    {
        return view('ormProfile');
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

        if($request['parent_page'] == "Login Page"){
            Auth::login($user = User::create([
                'fname' => $request['fname'],
                'mname' => $request['mname'],
                'lname' => $request['lname'],
                'gender' => $request['gender'],
                'role' => $request['role'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'confirm_password' => Hash::make($request['confirm_password']),
                // 'upload_img' => $request['upload_img'],
            ]));
    
            $file = $request->hasFile('upload_img');
            if ($file)
            {
                $upload_img = request()->file('upload_img')->getClientOriginalName();
                request()->file('upload_img')->move('images/', $upload_img);
                $user->update(['upload_img' => $upload_img]);
            }
    
            return redirect()->intended(route('dashboard'))->with('success', 'Login Successfully!', $user, 'user');
        } else if($request['parent_page'] == "User Management Page"){
            $user = User::create([
                'fname' => $request['fname'],
                'mname' => $request['mname'],
                'lname' => $request['lname'],
                'gender' => $request['gender'],
                'role' => $request['role'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'confirm_password' => Hash::make($request['confirm_password']),
                // 'upload_img' => $request['upload_img'],
            ]);
    
            $file = $request->hasFile('upload_img');
            if ($file)
            {
                $upload_img = request()->file('upload_img')->getClientOriginalName();
                request()->file('upload_img')->move('images/', $upload_img);
                $user->update(['upload_img' => $upload_img]);
            }
    
            return redirect()->intended(route('manage-user'))->with('success', 'Login Successfully!');
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

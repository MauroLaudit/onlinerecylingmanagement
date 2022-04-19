<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ormLoginController extends Controller
{
    /* SHow Login Page */
    public function login()
    {
        return view('auth.ormlogin');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }
    
    public function userRegistration(Request $request)
    {  
        $request->validate([
            'fname' => 'required|regex:/^[a-z A-Z]+s/u',
            'mname' => 'regex:/^[a-z A-Z]+s/u',
            'lname' => 'required|regex:/^[a-z A-Z]+s/u',
            'gender' => 'required|in:male,female',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'confirm_password' => 'required|same:password',
            'upload_img' => 'required|file|max:1024'
        ]);
    
        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }
    function registerUser(Request $request){
        $validateUserData = $request->validate([
            
        ]);
    }
    public function create(array $data)
    {
        return User::create([
        'fname' => $data['fname'],
        'mname' => $data['mname'],
        'lname' => $data['lname'],
        'gender' => $data['gender'],
        'role' => $data['role'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
        ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    
}

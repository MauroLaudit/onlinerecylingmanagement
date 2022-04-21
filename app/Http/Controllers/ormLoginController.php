<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Alert;

class ormLoginController extends Controller
{
    /* SHow Login Page */
    public function index()
    {
        return view('auth.ormLogin');
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
        return view('auth.ormRegistration');
    }
    
    public function userRegistration(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'regex:/^[a-z A-Z]+s/u'],
            'mname' => ['regex:/^[a-z A-Z]+s/u'],
            'lname' => ['required','regex:/^[a-z A-Z]+s/u'],
            'gender' => ['required','in:male,female'],
            'role' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:8','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'confirm_password' => ['required','same:password'],
            'upload_img' => ['required','file','max:1024'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors('Required field is empty')->withInput();
        }

        /* $user = User::create($request->all()); */

        Auth::login($user = User::create([
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'lname' => $request['lname'],
            'gender' => $request['gender'],
            'role' => $request['role'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]));
        /* $user->attachRole($request->role_id);   */
        event(new Registered($user));

        return redirect()->route('dashboard')->with('success', 'Login Successfully!');
        
    }
    
    /* public function create(array $data)
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
    }   */  
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('ormDashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    
}

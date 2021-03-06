<?php

namespace App\Http\Controllers;

use App\Models\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Alert;
use DB;

class ormLoginController extends Controller
{
    /* SHow Login Page */
    public function index()
    {
        $checkUsertbl = "";
        $modalClose = "";
        if(DB::table('users')->count() > 0){
            $checkUsertbl = "has user";
            $modalClose = "d-block";
        }else if(DB::table('users')->count() == 0){
            $checkUsertbl = "no user";
            $modalClose = "d-none";
        }

        return view('auth.ormLogin')->with('checkUsertbl', $checkUsertbl)->with('modalClose', $modalClose);
        
    }

    public function userLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $credential = User::where('email', '=', $request->email)->first();
        if (!$credential) {
            return back()->with('toast_error', 'Email Not Recognized!');
        }
        else {
            if (Hash::check($password, optional($credential)->password))
            {
                $request->session()->put('success');
                if (Auth::attempt(['email' => $email, 'password' => $password]))
                    {
                        return redirect()->intended(route('dashboard'))->with('success', 'Login Successfully!');
                    }
            }
            else {
                return back()->with('toast_error','Password Is Incorrect!');
            }
            
        }
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('ormDashboard');
        }

        return redirect("login")->withErrors('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ormLoginController extends Controller
{
    /* SHow Login Page */
    public function login()
    {
        return view('auth.ormlogin');
    }

    function registerUser(Request $request){
        $validateUserData = $request->validate([
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
    }
}

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
}

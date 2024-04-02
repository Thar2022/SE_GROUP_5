<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //check authentication
        if (Auth::user()) {
            if (Auth::user()->role == 1) {
                session()->put('role_name', 'admin');
                return view('admin.home');
            } elseif (Auth::user()->role == 2) {
                session()->put('role_name', 'repair');
                return view('auth.repair');
            } elseif (Auth::user()->role == 4) {
                session()->put('role_name', 'user');
                return view('auth.user');
            } elseif(Auth::user()->role == 3){

                //return view('auth.audit');
                session()->put('role_name', 'checkroom');
                return redirect()->route('checkroom');

            }
            else {
                return view('auth.home');
            }
        }
        else {
            return view('login');
        }
    }

    public function admin()
    {
        return view('admin');
    }

    public function audit()
    {
        return view('audit');
    }

    public function repair()
    {
        return view('repair');
    }

    public function edit()
    {
        return view('auth/edituser');
    }

    public function register()
{
    return view('register');
}

}

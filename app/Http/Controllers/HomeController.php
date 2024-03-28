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
                return view('auth.admin');
            } elseif (Auth::user()->role == 2) {
                session()->put('role_name', 'repair');
                return view('auth.repair');
            } elseif (Auth::user()->role == 3) {
                session()->put('role_name', 'user');
                return view('auth.user');
            } elseif(Auth::user()->role == 4){
                return view('auth.audit');
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
        return view('edituser');
    }
    
    public function register()
{
    return view('register');
}

}

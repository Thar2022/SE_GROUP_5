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
                return view('admin');
            } elseif (Auth::user()->role == 2) {
                return view('repair');
            } elseif (Auth::user()->role == 3) {
                return view('audit');
            } else {
                return view('home');
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

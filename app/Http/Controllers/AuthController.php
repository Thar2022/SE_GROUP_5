<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        try{
            //check duplicate email
            $checkEmail = User::where('email', $request->email)->first();
            if ($checkEmail) {
                return back()->with('error', 'Email already exists');
            }


            $employee = new Employee();

            $employee->fname = $request->fname;
            $employee->lname = $request->lname;
            //fname + lname in lowercase without space
            $employee->username = strtolower($request->fname . $request->lname);
            $employee->phone = $request->phone;
            $employee->email = $request->email;

            $employee->save();

            //save user
            $user = new User();

            $user->name = $request->fname . ' ' . $request->lname;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->id_emp = $employee->id;
        } catch (\Exception $e) {
            return back()->with('error', 'Error Register with message: ' . $e->getMessage());
        }

        $user->save();

        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            session(['user' => Auth::user()->name]);
            session(['role' => Auth::user()->role]);
            session(['id_emp' => Auth::user()->id_emp]);

            if (Auth::user()->role == 1) {
                return redirect('/home')->with('success', 'Login Success');
            }
        }

        return back()->with('error', 'Error Email or Password');
    }

    public function logout()
    {
        Auth::logout();
        session_unset();

        return redirect()->route('login');
    }
    public function loginAksi(Request $req)
    {
        if ($req->email == null or $req->password == null) {
            return redirect()->back()->with(['error' => 'Masukkan Email atau Password !']);
        } else {
            if (Auth::attempt([ 'email' => $req->email, 'password' => $req->password ])) {
                $user = Auth::user();
                if($user->level == 1){
                    return redirect()->route('admin');
                } else {
                    return redirect()->route('user');
                }
            } else {
                return redirect()->back()->with(['error' => 'Login Gagal !']);
            }
        }
    }
}

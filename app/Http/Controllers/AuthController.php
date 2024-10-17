<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        // validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // // authenticate user using query builder
        // $user = DB::table('users')->where('email', $request->email)->first();

        // authenticate user using eloquent ORM

        if (Auth::attempt($credentials)) {
            // session fixation attack: regenerate session id
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return redirect()->back()->withErrors([
            'error' => 'email or password is incorrect',
        ]);

    }

    public function store(Request $request)
    {
        // //csrf attack ->cross site request forgery
        // dd(redirect());

        // validation
        $request->validate([
            'username' => 'required|min:5|max:50',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],
        [
            'username.required' => 'username is required',
            'username.min' => 'username must be at least 5 characters'
        ]);

        // // store user in DB using query builder
        // DB::table('users')->insert([
        //     'name' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password)
        // ]);

        // store user in DB using eloquent ORM
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // flush all session data and regenerate session id
        $request->session()->invalidate();
        // regenerate csrf token
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}

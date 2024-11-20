<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.index');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            // dd(Auth::user());
            session(['role' => Auth::user()->role]);
            // dd(session('role'));
            return redirect()->route('dashboard');
        }

        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        //     return redirect()->route('dashboard');
        // }
        return redirect()->route('login')->with('error', 'Invalid email or password');
    }

    public function logout(Request $request){
        Auth::logout();  // Log out the user
        $request->session()->invalidate();  // Invalidate session data
        $request->session()->regenerateToken();  // Regenerate CSRF token
        return redirect()->route('login');  // Redirect to login page
    }
    
}

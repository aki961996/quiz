<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        $data = url()->current(); 
        if ($data) {
            return view('auth.register');
        } else {
            abort(404);
        }
    }


    // register user
    public function create_user(Request $request)
    {

      
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
          
            'password' => 'required|string|size:8',
        ]);

        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        
        $user->password = Hash::make(trim($request->password));
        $user->remember_token = Str::random(10);
        $user->save();

        return redirect()->route('login')->with('status', 'Your account created successfully');
    }


    // login user
    
  public function auth_login(Request $request)
{
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Login successful, redirect to dashboard
        return redirect()->route('quiz.index')->with('status', 'Login Successfully');
    } else {
        return redirect()->back()->with('error', 'Invalid Email or Password');
    }
}

    

    // logout user
    public function logout(Request $request)
    {
        Auth::logout(); // Logout the user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login')->with('status', 'Logout Successfully');
    }
}

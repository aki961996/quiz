<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetController extends Controller
{
    public function forgotPassword()
    {

        return view('auth.forgot');
    }
    public function postForgotPassword(Request $request)
    {
        // dd($request->all());
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);

            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->route('forgot-password')->with('success', 'Please check your email and reset your password');
        } else {
            return redirect()->route('forgot-password')->with('error', 'Email not found in the system');
        }
    }
    public function resetPassword($token)
    {
        $userReset = User::getResetSingle($token);
        // dd($userReset);
        if (!empty($userReset)) {
            $data['resetUserPassword'] = $userReset;

            return view('auth.resetPassword', $data);
        } else {
            abort(404);
        }
    }

    public function postReset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user =  User::getResetSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect()->route('main-logn')->with('success', 'Password Successfully Reset');
        } else {

            return redirect()->back()->with('error', 'Password and Confirm password does not match');
        }
    }
}

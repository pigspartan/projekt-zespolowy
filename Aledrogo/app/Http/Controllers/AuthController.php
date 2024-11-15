<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request)
    {
        // Validate
        $registerData = $request->validate([
            'name' => ['required', 'max:32'],
            'email' => ['required', 'max:128', 'unique:users'], #na potrzeby testów bo nie lubi sie z dev mailami paypala 'email',
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        // Register
        $user = User::create($registerData);

        // Login
        Auth::login($user);

        event(new Registered($user));

        // Redirect
        return redirect()->route('verification.notice');

    }

    public function verifyNotice(){
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request) {

        $request->fulfill();

        return redirect()->route('index');
    }

    public function verifyResend(Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => ['required', 'max:64', 'email'],
            'password' => ['required', 'min:4'],
        ]);

        if(Auth::attempt($loginData,$request->remember))
        {
            return redirect()->intended('');
        }else
        {
            return back()->withErrors(['failed'=>'bad credentials']);
        };

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regeneratetoken();
        return redirect()->route('index');
    }
}

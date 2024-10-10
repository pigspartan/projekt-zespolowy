<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register User
    public function register(Request $request){
        // Validate
        $registerData = $request->validate([
            'name' => ['required', 'max:32'],
            'email' => ['required', 'max:64', 'email', 'unique:users'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        // Register
        $user = User::create($registerData);

        // Login
        Auth::login($user);

        // Redirect
        return redirect()->route('index');
    }

    public function login(Request $request){
        dd($request);
    }
}

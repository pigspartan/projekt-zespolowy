<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $userId = Auth::id();

        $userItems = Listing::where('user_id',$userId)->latest()->get();


        return view('auth.dashboard', ['items' => $userItems]);
    }
}

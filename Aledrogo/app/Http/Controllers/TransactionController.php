<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function userTransactions($id){

        $bought = Transaction::where('buyer_id',$id)->with('listing')->get();
        $sold = Transaction::where('seller_id',$id)->with('listing')->get();

        return view('auth.userTransactions',['bought'=>$bought,'sold'=>$sold]);
    }
}

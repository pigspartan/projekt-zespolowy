<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::all();
        return view('listings.index',['listings'=>$listings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
        ]);
        $pathraw = Storage::disk('public')->put('img',$request->file);
        //Storage::disk('public')->put('img',$request->file);
        //$pathraw = $request->file('file')->storePublicly('storage');
        $pathbroken=explode('/',$pathraw);
        $path=$pathbroken[1];
        $fields['path'] = $path;
        //dd($pathraw);
        Auth::user()->listings()->create($fields);
        return back()->with('succes','post added');
    }

    /**1
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($perPage = 2)
    {
        //dd($perPage);
        if ($perPage != 2 && $perPage != 5 && $perPage != 10 && $perPage != 50){
            $perPage = 2;
        }

        $listings = Listing::latest()->paginate($perPage);


        return view('index',['listings'=>$listings,'perPage'=>$perPage]);
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
            'file' => ['required', 'image'],
        ]);

        $path = null;
        if ($request->hasFile('file')){
            $path = Storage::disk('public')->put('img',$request->file);
        }

        $fields['path'] = $path;
        request()->user()->listings()->create($fields);
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

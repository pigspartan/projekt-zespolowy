<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\patch;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($perPage = 5)
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
            'price'=>['required']
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
    public function show($id)
    {

        $item = Listing::findOrFail($id);
        //dd($item);
        return view('listings.details',['item' => $item]);
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
    public function destroy($id)
    {

        $listing = Listing::findOrFail($id);

        Gate::authorize('delete',$listing);

        $path = DB::table('listings')->where('id',$id)->firstOrFail()->path;

        Storage::disk('public')->delete($path);

        Listing::destroy($id);


        return redirect()->back();
    }
}

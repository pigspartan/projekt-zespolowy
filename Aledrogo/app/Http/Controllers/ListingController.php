<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Throwable;

use function Pest\Laravel\patch;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($perPage = 5)
    {
        //dd($perPage);
        if ($perPage != 2 && $perPage != 5 && $perPage != 10 && $perPage != 50) {
            $perPage = 2;
        }

        $listings = Listing::select('listings.*')
            ->leftJoin('flagged_listings', 'listings.id', '=', 'flagged_listings.listing_id')
            ->leftJoin('user_role', 'listings.user_id', '=', 'user_role.user_id')
            ->selectRaw('COUNT(flagged_listings.id) as flagged_count')
            ->having('user_role.role_id', '!=', 3)
            ->groupBy('listings.id')
            ->having('flagged_count', '<', 6)
            ->where('status','!=','sold')->latest()->paginate($perPage);



        return view('index', ['listings' => $listings, 'perPage' => $perPage]);
    }

    public function userListings($id, $perPage = 5)
    {

        if (User::find($id)->hasRole('Suspended')) {
            return redirect()->back();
        }

        $listings = Listing::select('listings.*')
            ->leftJoin('flagged_listings', 'listings.id', '=', 'flagged_listings.listing_id')
            ->where('listings.user_id', $id)
            ->selectRaw('COUNT(flagged_listings.id) as flagged_count')
            ->groupBy('listings.id')
            ->having('flagged_count', '<', 6)->latest()->paginate($perPage);

        $name = User::findOrFail($id)->name;

        return view('userListings', ['listings' => sizeof($listings) > 0 ? $listings : null, 'userName' => $name, 'perPage' => $perPage]);
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
            'price' => ['required']
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = Storage::disk('public')->put('img', $request->file);
        }

        $fields['path'] = $path;
        request()->user()->listings()->create($fields);
        //return back()->with('succes','post added');
        return redirect()->route('index');
    }

    /**1
     * Display the specified resource.
     */
    public function show($id)
    {

        $canFlag = true;

        $item = Listing::with('flaggedByUsers')->findOrFail($id);

        $flags = $item->flaggedByUsers();

        if ($flags->find(Auth::id()) != null) {
            $canFlag = false;
        }

        if ($item->user->hasRole('Suspended')) {
            return redirect()->back();
        }

        //dd($item);
        return view('listings.details', ['item' => $item, 'canFlag' => $canFlag]);
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

        DB::transaction(function () use ($id) {


            $listing = Listing::findOrFail($id);

            Gate::authorize('delete', $listing);

            $path = DB::table('listings')->where('id', $id)->firstOrFail()->path;

            Storage::disk('public')->delete($path);

            Listing::destroy($id);

        });


        return redirect()->back();
    }

    public function flag(Request $request, $listingId)
    {

        try {


            $listing = Listing::findOrFail($listingId);

            if (User::find(Auth::id())->flaggedListings()->find($listingId) != null) {
                return redirect()->back()->with('error', 'Już oflagowałeś to ogłoszenie');
            }

            $listing->flaggedByUsers()->attach(Auth::id(), [
                'reason' => $request->reason,
            ]);

            return redirect()->back()->with('success', 'Ogłoszenie zostało oflagowane');
        } catch (Throwable $e) {
            return response()->view('errors', status: 400);
        }

    }

    public function unflag($listingId)
    {


        $listing = Listing::findOrFail($listingId);

        $listing->flaggedByUsers()->detach();

        return redirect()->back()->with('success', 'Flagi ogłoszenia zostały usunięte');

    }
}

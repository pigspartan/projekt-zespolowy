<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index() {


        $listings = Listing::whereHas('flaggedByUsers')->withCount('flaggedByUsers as timesFlagged')->with('flaggedByUsers')->get();

        $users = User::where('id','!=',Auth::id())->get();

        $roles = Role::get();

        return view('auth.adminDashboard', ['listings'=>$listings, 'users' => $users, 'roles' => $roles]);
    }

    public function assignRole($userId, $roleId){

        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);

        if ($user->hasRole($role->name)){
            return redirect()->back()->with(['message'=> 'Do użytkownika jest już przypisana taka rola']);
        }

        $user->assignRole($role->name);
        return redirect()->back()->with(['message'=> 'Pomyślnie przypisano rolę']);
    }

    public function suspendUser($id){
        $user = User::findOrFail($id);

        $user->revokeAllRoles();

        $user->assignRole('Suspended');

        return redirect()->back()->with(['message'=> 'Użytkownik zawieszony']);
    }

    public function restoreUser($id){
        $user = User::findOrFail($id);

        $user->revokeAllRoles();

        $user->assignRole('User');

        return redirect()->back()->with(['message'=> 'Użytkownik przywrócony']);
    }

    public function deleteUser($id){
        DB::transaction(function () use ($id) {

            Gate::authorize('delete',Auth::user());


            DB::table('users')->delete($id);
        });

        return redirect()->back()->with(['message'=> 'Użytkownik usunięty']);
    }

    public function inspectUser($userId) {

        $user = User::with('flaggedListings')->findOrFail($userId);

        return view('auth.inspectUser', ['user' => $user]);
    }
}

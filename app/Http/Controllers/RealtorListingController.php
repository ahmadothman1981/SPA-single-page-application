<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class RealtorListingController extends Controller
{
    public function index(Request $request)
    {
        //dd(Auth::user()->listings);
       // dd((bool)$request->get('deleted'));
       $filters = [
        'deleted' => $request->boolean('deleted') ];
        $userListings = Auth::user()->listings()->mostRecent()->filter($filters)->get();


        return inertia('Realtor/index',['listings' => $userListings]);
    }
      public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing);
        $listing->deleteOrFail();
        return redirect()->back()
        ->with('success','Listing deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class RealtorListingController extends Controller
{
    public function index()
    {
        //dd(Auth::user()->listings);
        $userListings = Auth::user()->listings;

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

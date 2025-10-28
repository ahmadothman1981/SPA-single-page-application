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
        'deleted' => $request->boolean('deleted'),...$request->only(['by','order']) ];
        $userListings = Auth::user()->listings()
        ->filter($filters)
        ->paginate(5)
        ->withQueryString();


        return inertia('Realtor/index',['filters' => $filters,'listings' => $userListings]);
    }
     
     public function create()
    {
        Gate::authorize('create', Listing::class);
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
   Listing::create(
            $request->validate([
                'beds' => 'required|integer|min:0',
                'baths' => 'required|integer|min:0',
                'area' => 'required|integer|min:0',
                'price' => 'required|integer|min:0',
                'city' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'street_nr' => 'required|string|max:255',
            ]));
           
   return redirect()->route('realtor.listings.index')
   ->with('success','Listing created successfully');
    }
      public function edit(Listing $listing )
    {
        Gate::authorize('update', $listing);
         return inertia('Realtor/Edit' ,['listing'=>$listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        Gate::authorize('update', $listing);
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0',
                'baths' => 'required|integer|min:0',
                'area' => 'required|integer|min:0',
                'price' => 'required|integer|min:0',
                'city' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'street_nr' => 'required|string|max:255',
            ]));
           
   return redirect()->route('realtor.listings.index')
   ->with('success','Listing updated successfully');
    }
     public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing);
        $listing->deleteOrFail();
        return redirect()->back()
        ->with('success','Listing deleted successfully');
    }
    public function restore(Listing $listing)
    {
       
        Gate::authorize('restore', $listing);
        $listing->restore();
        return redirect()->back()
        ->with('success','Listing restored successfully');
    }
}

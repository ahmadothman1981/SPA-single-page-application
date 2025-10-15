<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                return inertia('Listing/Index' ,['listings'=>Listing::all()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return inertia('Listing/Create');
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
           
   return redirect()->route('listings.index')
   ->with('success','Listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         return inertia('Listing/Show' ,['listing'=>Listing::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing )
    {
         return inertia('Listing/Edit' ,['listing'=>$listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
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
           
   return redirect()->route('listings.index')
   ->with('success','Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()
        ->with('success','Listing deleted successfully');
    }
}

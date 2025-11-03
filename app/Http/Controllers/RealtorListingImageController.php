<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
       
        return inertia('Realtor/ListingsImages/Create',[
            'listing' => $listing,
        ]);
    }
    public function store( Listing $listing, Request $request)
    {
       
        //  $request->validate([
        //     'files' => 'required|array',
        //     'files.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        // ]);
       if($request->hasFile('files'))
        {
        $files = $request->file('files');
        foreach($files as $file){
         $path = $file->store('images','public');
            $listing->images()->create([
                'filename' => $path,
               
                ]);
        }
       }
       return redirect()->back()->with('success','Images uploaded successfully');
    }
}

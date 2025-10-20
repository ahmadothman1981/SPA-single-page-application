<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class ListingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    

    $priceFrom = $request->input('priceFrom');
    $priceFrom = $priceFrom === '' ? null : $priceFrom;
    $priceTo = $request->input('priceTo');
    $priceTo = $priceTo === '' ? null : $priceTo;
    $beds = $request->input('beds');
    $beds = $beds === '' ? null : $beds;
    $baths = $request->input('baths');
    $baths = $baths === '' ? null : $baths;
    $areaFrom = $request->input('areaFrom');
    $areaFrom = $areaFrom === '' ? null : $areaFrom;
    $areaTo = $request->input('areaTo');
    $areaTo = $areaTo === '' ? null : $areaTo;  

    $query = Listing::MostRecent()->filter([ 'priceFrom' => $priceFrom,
        'priceTo' => $priceTo,
        'beds' => $beds,
        'baths' => $baths,
        'areaFrom' => $areaFrom,
        'areaTo' => $areaTo,]
       
    );
    


    // Get filters safely
   

    // Apply price filters
    // if ($priceFrom !== null) {
    //     $query->where('price', '>=', (int) $priceFrom);
    // }
    // if ($priceTo !== null) {
    //     $query->where('price', '<=', (int) $priceTo);
    // }

    // Apply beds
    // if ($beds !== null) {
    //     if ($beds == 6) {
    //         $query->where('beds', '>=', 6);
    //     } else {
    //         $query->where('beds', (int) $beds);
    //     }
    // }

    // // Apply baths
    // if ($baths !== null) {
    //     if ($baths == 6) {
    //         $query->where('baths', '>=', 6);
    //     } else {
    //         $query->where('baths', (int) $baths);
    //     }
    // }

    // // Apply area
    // if ($areaFrom !== null) {
    //     $query->where('area', '>=', (int) $areaFrom);
    // }
    // if ($areaTo !== null) {
    //     $query->where('area', '<=', (int) $areaTo);
    // }

    return inertia('Listing/Index', [
        'listings' => $query->paginate(10)->withQueryString(),
        'filters' => [
            'priceFrom' => $priceFrom,
            'priceTo' => $priceTo,
            'beds' => $beds,
            'baths' => $baths,
            'areaFrom' => $areaFrom,
            'areaTo' => $areaTo,
        ],
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Listing::class);
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
   public function show(Listing $listing)
{
    
    //using policy to check if user is authorized to view the listing
    Gate::authorize('view', $listing);
    return inertia('Listing/Show', ['listing' => $listing]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing )
    {
        Gate::authorize('update', $listing);
         return inertia('Listing/Edit' ,['listing'=>$listing]);
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
           
   return redirect()->route('listings.index')
   ->with('success','Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing);
        $listing->delete();
        return redirect()->back()
        ->with('success','Listing deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ListingRequest;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);
        return view('listings.index', compact('listings'));
    }

    /**r
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $listing = null;
        return view('listings.create', ['listing' => $listing]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
        $data = $request->except('file');


        if ($request->hasFile('logo')) {
            $filePath = $request->file('logo')->store('logos', 'public');
            // dd($filePath);
            $data['path'] = $filePath;
        }
        Listing::create($data);
        return redirect()->route('listing.index')->with(Session::flash('message', "New Listing Successfully added"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        //
        return view('listings.create', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $data = $request->except('file');


        if ($request->hasFile('logo')) {
            $filePath = $request->file('logo')->store('logos', 'public');
            // dd($filePath);
            $data['path'] = $filePath;
        }
        
        $listing->update($data);
        return back()->with(Session::flash('message', " Listing Successfully Updated "));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
        $listing->delete();
        return redirect()->route('listing.index')->with(Session::flash('message', " Listing Successfully deleted"));
    }
}

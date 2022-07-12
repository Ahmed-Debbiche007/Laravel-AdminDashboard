<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ListingController extends Controller
{
    public function index($id)
    {
        return view('dashboard.listing', [
            'listings' => Listing::find($id),
            'allListings' => Listing::latest()->get()->count(),
        ]);
    }

    public function addListing()
    {
        return view('dashboard.addListing', [
            'users' => Listing::all(),
            'allListings' => Listing::latest()->get()->count(),
        ]);
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'quantity' => ['required'],
            'tva' => ['required'],
            'description' => ['required'],

        ]);

        $formFields['photo'] = "null";
        Listing::create($formFields);

        return redirect('/Listings')->withSuccess('Listing added successfully.');
    }

    public function edit($id)
    {
        return view('dashboard.editListing', [
            'listings' => Listing::find($id),
            'allListings' => Listing::latest()->get()->count(),
        ]);
    }
    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'quantity' => ['required'],
            'tva' => ['required'],
            'description' => ['required'],

        ]);
        $listing->name = $request->input('name');
        $listing->tags = $request->input('tags');
        $listing->description = $request->input('description');
        $listing->price = $request->input('price');
        $listing->quantity = $request->input('quantity');
        $listing->tva = $request->input('tva');
        $listing->photo = "Null";

        $listing->update();

        return redirect('/Listings')->withSuccess('Listing updated successfully.');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/Listings')->withSuccess('Listing deleted successfully.');
    }

}

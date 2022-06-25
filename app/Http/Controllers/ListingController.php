<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index($id)
    {
        return view('dashboard.listing' , [
            'listings' => Listing::find($id),
            'allListings' => Listing::latest() -> get() -> count(),
        ]);
    }

    public function addListing()
    {
        return view('dashboard.addListing', [
            'users' => Listing::all(),
            'allListings' => Listing::latest() -> get() -> count(),
        ]);
    }

    public function store(Request $request){
        
        $formFields= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description'=>['required'],

        ]);
      
        $formFields['photo']="null";
        Listing::create($formFields);

        return redirect('/Listings')->withSuccess('Listing added successfully.');
    }

    public function edit($id)
    {
        return view('dashboard.editListing' , [
            'listings' => Listing::find($id),
            'allListings' => Listing::latest() -> get() -> count(),
        ]);
    }
    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'quantity' => ['required'],
            'description'=>['required'],

        ]);
        $listing->name = $request->input('name');
        $listing->tags = $request->input('tags');
        $listing->description = $request->input('description');
        $listing->price = $request->input('price');
        $listing->quantity = $request->input('quantity');
        $listing->photo = "Null";
       
        $listing->update();

        return redirect('/Listings')->withSuccess('Listing updated successfully.');
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/Listings')->withSuccess('Listing deleted successfully.');

    }




    public function products()
    {
       
        return view('products',[
            'listings' => Listing::latest()->filter(request(['search','tag']))->paginate(8),
        ]);
    }

    public function index2($id)
    {
        return view('product' , [
            'listings' => Listing::find($id),
        ]);
    }

    public function cart()
    {
        return view('cart');
    }

     /**
     * Write code on Method
     *
     * @return response()
     */

    public function addToCart($id)
    {
        $product = Listing::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->withSuccess('Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    

}

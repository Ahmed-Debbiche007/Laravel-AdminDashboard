<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use PDF;

class CartController extends Controller
{
    public function products()
    {

        return view('products', [
            'listings' => Listing::latest()->filter(request(['search', 'tag']))->paginate(8),
        ]);
    }

    public function index($id)
    {
        return view('product', [
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

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "tva" => $product->tva,
                "image" => $product->photo
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
        if ($request->id && $request->quantity) {
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
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function getPDF()
    {

        $user = Auth::user();
        $data = [
            'user' => $user,
            'date' => date('d/m/Y')
        ];
        $pdf = PDF::loadView('invoice.cartTemplate', $data);
        $filename = 'Bill.pdf';
        return $pdf->stream($filename);

    }
}

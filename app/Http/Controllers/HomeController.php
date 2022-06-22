<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Listing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home', [
            'users' => user::latest()->filter(request(['search']))->paginate(10),
            'allUsers' => user::latest() -> get() -> count(),
        ]);
    }

    // Show the Products
    public function listings()
    {
       
        return view('dashboard.listings',[
            'listings' => Listing::latest()->paginate(10),
            'allListings' => Listing::latest() -> get() -> count(),
        ]);
    }

    public function clients()
    {
       
        return view('dashboard.clients',[
            'clients' => Client::latest()->paginate(10),
            'allClients' => Client::latest() -> get() -> count(),
        ] );
    }



}

<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'allUsers' => user::latest() -> get(),
        ]);
    }

    // Show the Products
    public function listings()
    {
       
        return view('dashboard.listings');
    }



}

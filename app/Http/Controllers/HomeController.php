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
        return view('home', [
            'users' => user::latest()->filter(request(['search']))->paginate(5),
            'allUsers' => user::latest() -> get(),
        ]);
    }

    
    public function listings()
    {
       
        return view('listings', [
            'users' => user::all()
        ]);
    }

    public function addUsers()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('addUser', [
            'users' => user::all()
        ]);
    }

}

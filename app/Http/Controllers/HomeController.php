<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Invoice;
use App\Models\Listing;
use App\Models\Quote;
use App\Models\Statement;
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
            'users' => user::where('role','not like','Client')->filter(request(['search']))->paginate(10),
            'allUsers' => user::where('role','not like','Client')->count(),
        ]);
    }

    // Show the Products
    public function listings()
    {
       
        return view('dashboard.listings',[
            'listings' => Listing::latest()->filter(request(['search']))->paginate(8),
            'allListings' => Listing::latest() -> get() -> count(),
        ]);
    }

    public function clients()
    {
       
        return view('dashboard.clients',[
            'clients' => user::latest()->where('role','like','Client')->filter(request(['search']))->paginate(10),
            'allClients' =>  user::latest()->where('role','like','Client')-> get() -> count(),
        ] );
    }

    public function invoices()
    {
       
        return view('statement.index',[
            'statements' =>Statement::join('invoices', 'statements.id','=','invoices.statement_id')->filter(request(['search']))->paginate(10),
            'allStatements' =>  Invoice::latest()->get() -> count(),
            'type' => 'Invoice',
        ] );
    }

    public function quotes()
    {
       
        return view('statement.index',[
            'statements' =>Statement::join('quotes', 'statements.id','=','quotes.statement_id')->filter(request(['search']))->paginate(10),
            'allStatements' =>  Quote::latest()->get() -> count(),
            'type' => 'Quote',
        ] );
    }

 

    
    //$invoices = Statement::join('invoices', 'statements.id','=','invoices.statement_id')->get(['statements.*','invoices.id']) ;
    // $quotes = Statement::join('quotes', 'statements.id','=','quotes.statement_id')->get(['statements.*','quotes.id']) ;


}

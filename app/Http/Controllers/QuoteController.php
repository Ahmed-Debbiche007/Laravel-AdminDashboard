<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statement;
use App\Models\Invoice;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index($id)
    {
        return app('App\Http\Controllers\StatementController')->index($id, 'quotes', 'Quote');
    }

    public function addQuote()
    {
        return app('App\Http\Controllers\StatementController')->addStatement('Quote');
    }


    public function store(Request $request)
    {
        app('App\Http\Controllers\StatementController')->store($request);
        $statement = Statement::latest()->first();
        $quote = new Quote();
        $quote->statement_id = $statement->id;
        $quote->save();

        return redirect('/Quotes')->withSuccess('Quote added successfully.');

    }

    public function edit($id)
    {
        return app('App\Http\Controllers\StatementController')->edit($id,'quote', 'Quote');
    }

    public function update(Request $request, $id){
        $statement = Statement::find($id);
        app('App\Http\Controllers\StatementController')->update($request, $statement);
        return redirect('/Quotes')->withSuccess('Quote updated successfully.');
    }

    public function destroy( $quote){
        $statement = Statement::find($quote);
        Quote::where('statement_id',$quote)->delete();
        $old = Invoice::where('statement_id',$statement->id)->first();
        if($old == null){
        app('App\Http\Controllers\StatementController')->destroy($statement);
        return redirect('/Quotes')->withSuccess('Quote deleted successfully.');
        }
        else {
            return redirect('/Quotes')->withSuccess('Quote deleted successfully.');
        }
    }

    public function getPDF ($quote){
        $statement = Statement::find($quote);
        $id = Quote::where('statement_id',$quote)->first()->id;
        return app('App\Http\Controllers\StatementController')->getPDF($statement, 'QUOTE', $id);
    }

    public function makeInvoice ($quote){
        $statement = Statement::find($quote);
        $old = Invoice::where('statement_id',$statement->id)->first();
        if($old == null){
        $invoice = new Invoice();
        $invoice->statement_id = $statement->id;
        $invoice->save();
        return redirect('/Invoices')->withSuccess('Invoice added successfully.');
    }
    else {
        return redirect('/Quotes')->withErrors('Invoice exists!');
    }
    }
}

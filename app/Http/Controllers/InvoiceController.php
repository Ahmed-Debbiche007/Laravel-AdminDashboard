<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Statement;
use App\Models\Invoice;
use App\Models\Quote;
class InvoiceController extends Controller
{
    public function index($id)
    {
        return app('App\Http\Controllers\StatementController')->index($id, 'invoices', 'Invoice');
    }

    public function addInvoice()
    {
        return app('App\Http\Controllers\StatementController')->addStatement('Invoice');
    }


    public function store(Request $request)
    {
        app('App\Http\Controllers\StatementController')->store($request , 'Invoice');
        $statement = Statement::latest()->first();
        $invoice = new Invoice();
        $invoice->statement_id = $statement->id;
        $invoice->save();

        return redirect('/Invoices')->withSuccess('Invoice added successfully.');

    }

    public function edit($id)
    {
        return app('App\Http\Controllers\StatementController')->edit($id,'invoice', 'Invoice');
    }

    public function update(Request $request, $id){
        $statement = Statement::find($id);
        app('App\Http\Controllers\StatementController')->update($request, $statement, "Invoice");
        return redirect('/Invoices')->withSuccess('Invoice updated successfully.');
    }

    public function destroy( $invoice){
        $statement = Statement::find($invoice);
        Invoice::where('statement_id',$invoice)->delete();
        $old = Quote::where('statement_id',$statement->id)->first();
        if($old == null){
        app('App\Http\Controllers\StatementController')->destroy($statement);
        return redirect('/Invoices')->withSuccess('Invoice deleted successfully.');
        }
        else {
            return redirect('/Invoices')->withSuccess('Invoice deleted successfully.');
        }
    }

    public function getPDF ($invoice){
        $statement = Statement::find($invoice);
        $id = Invoice::where('statement_id',$invoice)->first()->id;
        return app('App\Http\Controllers\StatementController')->getPDF($statement, 'INVOICE',$id);
    }
}

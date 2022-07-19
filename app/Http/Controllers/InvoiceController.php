<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use PDF;
use DB;

class InvoiceController extends Controller
{
    public function index($id)
    {
        $invoice = Invoice::find($id);
        $client = User::find($invoice->client_id) ;
        $invoiceItems = InvoiceItem::all()->where('invoice_id','like',$id);
        $listings =array();
        foreach($invoiceItems as $item){           
            $listing = Listing::find($item->listing_id);
            $listing->quantity = $item->quantity;
            $listing->discount = $item->discount;
            array_push($listings, $listing)   ;         
        }
        return view('invoice.invoices', [
            'invoices' => $invoice,
            'client' => $client,
            'listings' => $listings,

        ]);
    }

    public function addInvoice()
    {
        return view('invoice.addInvoice', [
            'listings' => Listing::all(),
            'clients' =>  user::latest()->where('role', 'like', 'Client')->get(),

        ]);
    }


    public function calculTotal ($request){
        $tht = 0;
        $ttc = $request->timbreFiscal;
        $tva = 0;
        $discount= 0;
        $totalDiscount=0;
        $totalTva=0;
        $length = count($request->listing);

        for ($x = 0; $x < $length; $x++) {
            $listing = Listing::find($request->listing[$x]);
            $discount =($listing->price * $request->quantity[$x] * ($request->discount[$x]) / 100);
            $totalDiscount= $totalDiscount+$discount;
            $tht = $tht + $listing->price * $request->quantity[$x]-$discount;
            $tva = ($listing->price * $request->quantity[$x]) * ($listing->tva / 100);
            $totalTva = $totalTva+$tva;
            $ttc = $ttc + $tva + ($listing->price  * $request->quantity[$x] * (100 - $request->discount[$x]) / 100);
        }

        return [
            'tva'=> $tva,
            'tht'=> $tht,
            'ttc'=> $ttc,
            'totalTva'=>$totalTva,
            'totalDiscount' => $totalDiscount,
        ];
    }


    public function createItems(Request $request){
        for ($i=0; $i< count($request->listing);$i++){
            $item = new InvoiceItem();
            $item->invoice_id = Invoice::latest()->first()->id;
            $item->listing_id = $request->listing[$i];
            $item->quantity = $request->quantity[$i];
            $item->discount = $request->discount[$i];
            $item->save();
         }
    }

    public function updateItems(Request $request, Invoice $invoice){
        DB::delete('delete from invoice_items where invoice_id = ?',[$invoice->id]);
        for ($i=0; $i< count($request->listing);$i++){
            $item = new InvoiceItem();
            $item->invoice_id = $invoice->id;
            $item->listing_id = $request->listing[$i];
            $item->quantity = $request->quantity[$i];
            $item->discount = $request->discount[$i];
            $item->save();
         }
        

    }

    public function store(Request $request)
    {
        
        $formFields = $request->validate([
            'client_id' => ['required'],
            'timbreFiscal' => ['required'],
            'tht' => ['required'],
            'ttc' => ['required'],
        ]);
        $total = $this->calculTotal($request);
        $formFields['tht'] = $total['tht'];
        $formFields['ttc'] = $total['ttc'];
        $formFields['gqte'] = array_sum($request->quantity);
        $formFields['tva'] = $total['totalTva'];

        Invoice::create($formFields);
        //$user = User::find($request->client_id);
        $this->createItems($request);       

        return redirect('/Invoices')->withSuccess('Invoice added successfully.');
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $client = User::find($invoice->client_id) ;
        $invoiceItems = InvoiceItem::all()->where('invoice_id','like',$id);
        $listings =array();
        foreach($invoiceItems as $item){           
            $listing = Listing::find($item->listing_id);
            $listing->quantity = $item->quantity;
            $listing->discount = $item->discount;
            array_push($listings, $listing)   ;         
        }
        return view('invoice.editInvoice', [
            'invoices' => $invoice,
            'client' => $client,
            'listings' => $listings,
            'clients' =>  user::latest()->where('role', 'like', 'Client')->get(),
            'olistings' => Listing::all(),
        ]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $formFields = $request->validate([
            'client_id' => ['required'],
            'timbreFiscal' => ['required'],
            'tht' => ['required'],
            'ttc' => ['required'],
        ]);
        $total = $this->calculTotal($request);
        $formFields['tht'] = $total['tht'];
        $formFields['ttc'] = $total['ttc'];
        $formFields['gqte'] = array_sum($request->quantity);
        $formFields['tva'] = $total['totalTva'];
        $invoice->client_id = $formFields['client_id'];
        $invoice->timbreFiscal = $formFields['timbreFiscal'];
        $invoice->tht = $formFields['tht'];
        $invoice->ttc = $formFields['ttc'];
        $invoice->gqte = $formFields['gqte'];
        $invoice->tva = $formFields['tva'];
        $invoice->update();
        $this->updateItems($request, $invoice);  
        return redirect('/Invoices')->withSuccess('Invoice updated successfully.');
        
    }

    public function destroy(Invoice $invoice){
        $invoice->delete();
        return redirect('/Invoices')->withSuccess('Invoice deleted successfully.');

    }

    public function getPDF(Invoice $invoice){
        $user = User::find($invoice->client_id);
        $invoiceItems = InvoiceItem::all()->where('invoice_id',$invoice->id);
        
        $listings = array();       
        $discounts = array();
        $quantities = array();
        foreach ($invoiceItems as $item){
            $quantity = $item->quantity;
            array_push($quantities, $quantity);
            $discount = $item->discount;
            array_push($discounts, $discount);
            $listing = Listing::find($item->listing_id);
            array_push($listings, $listing);
        }
        $table = $this->calculTva($invoice);
       
        $date=date('d/m/Y', strtotime($invoice->created_at));

        $data=[
            'invoice' => $invoice,
            'user' => $user,
            'date' => $date,
            'tht' => $invoice->tht,
            'ttc' =>$invoice->ttc,
            'tva' => $invoice->tva,
            'Gquantity' =>$invoice->gqte,
            'listings' => $listings,
            'timbre' => $invoice->timbreFiscal,
            'discount' => $discounts,
            'totalDiscount' =>$this->calculTotal2($invoice),
            'quantity' => $quantities,
            'table' =>$table,
        ];
       
        $pdf = PDF::loadView('invoice.invoiceTemplate', $data);
        $filename = 'Bill.pdf';
        return $pdf->stream($filename);
    }

    public function calculTotal2($invoice){
         $invoiceItems = InvoiceItem::all()->where('invoice_id',$invoice->id);
        $discount= 0;
        $totalDiscount=0;
        foreach ($invoiceItems as $item) {
            $listing = Listing::find($item->listing_id);
            $discount =($listing->price * $item->quantity * ($item->discount) / 100);
            $totalDiscount= $totalDiscount+$discount;
        }

        return $totalDiscount;

    }

    public function calculTva($invoice)
    {
        $invoiceItems = InvoiceItem::all()->where('invoice_id',$invoice->id);
        $table = array();

        foreach ($invoiceItems as $item) {
            $listing = Listing::find($item->listing_id);
            $amount = ($listing->price * $item->quantity) * ($listing->tva) / 100;
            $base = ($listing->price *$item->quantity);
            $key = (string) $listing->tva;
            if (array_key_exists($key, $table)) {
                $table[$key][0] =  $table[$key][0] + $base;
                $table[$key][1] =  $table[$key][1] + $amount;
            } else {
                $table[$key][0] =  $base;
                $table[$key][1] =  $amount;
            }
        }
        return $table;
    }
}

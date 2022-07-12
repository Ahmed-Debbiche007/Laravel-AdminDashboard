<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use PDF;

class InvoiceController extends Controller
{
    public function index($id)
    {
        return view('invoice.index', [
            'invoices' => Invoice::find($id),
            'allInvoices' => Invoice::latest()->get()->count(),
        ]);
    }

    public function addInvoice()
    {
        return view('invoice.addInvoice', [
            'listings' => Listing::all(),
            'clients' =>  user::latest()->where('role', 'like', 'Client')->get(),

        ]);
    }

    public function calculTva(Request $request)
    {
        $listings = $request->listing;
        $table = array();

        for ($i = 0; $i < count($listings); $i++) {
            $listing = Listing::find($listings[$i]);
            $amount = ($listing->price * $request->quantity[$i]) * ($listing->tva) / 100;
            $base = ($listing->price * $request->quantity[$i]);
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

        Invoice::create($formFields);
        $user = User::find($request->client_id);

        for ($i=0; $i< count($request->listing);$i++){
           $item = new InvoiceItem();
           $item->invoice_id = Invoice::latest()->first()->id;
           $item->listing_id = $request->listing[$i];
           $item->quantity = $request->quantity[$i];
           $item->discount = $request->discount[$i];
           $item->save();
        }

        $data = [
            'invoice' => Invoice::latest()->first(),
            'user' => $user,
            'date' => date('d/m/Y'),
            'tht' => $total['tht'],
            'ttc' => $total['ttc'],
            'tva' => $total['totalTva'],
            'listings' => Listing::find($request->listing),
            'timbre' => $request->timbreFiscal,
            'discount' => $request->discount,
            'totalDiscount' =>$total['totalDiscount'],
            'quantity' => $request->quantity,
            'table' => $this->calculTva($request),
            'Gquantity' =>array_sum($request->quantity),
        ];




        $pdf = PDF::loadView('invoice.invoiceTemplate', $data);
        $filename = 'Bill.pdf';
        return $pdf->stream($filename);
    }
}

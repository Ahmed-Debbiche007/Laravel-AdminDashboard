<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Listing;
use App\Models\Statement;
use App\Models\StatementItem;
use Illuminate\Support\Arr;
use PDF;
use DB;
use PhpParser\PrettyPrinter\Standard;

class StatementController extends Controller
{
    public function index($id, $table, $type)
    {
        $statement = Statement::join($table, 'statements.id', '=', $table . '.statement_id')->where('statement_id', $id)->first();

        $client = Client::find($statement->client_id);

        $statementItems = StatementItem::all()->where('statement_id', 'like', $id);
        $listings = array();
        foreach ($statementItems as $item) {
            $listing = Listing::find($item->listing_id);
            $listing->quantity = $item->quantity;
            $listing->discount = $item->discount;
            $listing->price = $item->price;
            array_push($listings, $listing);
        }
        return view('statement.statements', [
            'statements' => $statement,
            'client' => $client,
            'listings' => $listings,
            'type' => $type,

        ]);
    }

    public function addStatement($type)
    {
        return view('statement.addStatement', [
            'listings' => Listing::all(),
            'clients' =>  Client::latest()->get(),
            'type' => $type,

        ]);
    }


    public function calculTotal($request,$type)
    {
        $tht = 0;
        $ttc = 0;
        if ($type == 'Invoice'){
            $ttc = $request->timbreFiscal;
        }
        $tva = 0;
        $discount = 0;
        $totalDiscount = 0;
        $totalTva = 0;
        $length = count($request->listing);

        for ($x = 0; $x < $length; $x++) {
            $listing = Listing::find($request->listing[$x]);
            $discount = ($request->price[$x] * $request->quantity[$x] * ($request->discount[$x]) / 100);
            $totalDiscount = $totalDiscount + $discount;
            $tht = $tht + $request->price[$x] * $request->quantity[$x] - $discount;
            $tva = ($request->price[$x] * $request->quantity[$x]) * ($listing->tva / 100);
            $totalTva = $totalTva + $tva;
            $ttc = $ttc + $tva + ($request->price[$x]  * $request->quantity[$x] * (100 - $request->discount[$x]) / 100);
        }

        return [
            'tva' => $tva,
            'tht' => $tht,
            'ttc' => $ttc,
            'totalTva' => $totalTva,
            'totalDiscount' => $totalDiscount,
        ];
    }


    public function createItems(Request $request)
    {
        for ($i = 0; $i < count($request->listing); $i++) {
            $item = new StatementItem();
            $item->statement_id = Statement::latest()->first()->id;
            $item->listing_id = $request->listing[$i];
            $item->quantity = $request->quantity[$i];
            $item->discount = $request->discount[$i];
            $item->price = $request->price[$i];
            $item->save();
        }
    }

    public function updateItems(Request $request, Statement $statement)
    {
        DB::delete('delete from statement_items where statement_id = ?', [$statement->id]);
        $this->createItems($request);
    }

    public function store(Request $request, $type)
    {

        $formFields = $request->validate([
            'client_id' => ['required'],
            'tht' => ['required'],
            'ttc' => ['required'],
            'timbreFiscal' =>[] ,
        ]);
        $total = $this->calculTotal($request, $type);
        $formFields['tht'] = $total['tht'];
        $formFields['gqte'] = array_sum($request->quantity);
        $formFields['tva'] = $total['totalTva'];
        if ((!Arr::exists($formFields, 'timbreFiscal') && ($type =='Invoice') )) {
            $formFields['timbreFiscal']= 0.6;
        }
        if ((!Arr::exists($formFields, 'timbreFiscal') && ($type =='Quote') )) {
            $formFields['timbreFiscal']= 0;
        }
        $formFields['ttc'] = $total['ttc']+$formFields['timbreFiscal'];
        Statement::create($formFields);
        //$user = User::find($request->client_id);
        $this->createItems($request);
    }

    public function edit($id, $type, $action)
    {
        $statement = Statement::find($id);
        $client = Client::find($statement->client_id);
        $statementItems = StatementItem::all()->where('statement_id', 'like', $id);
        $listings = array();
        foreach ($statementItems as $item) {
            $listing = Listing::find($item->listing_id);
            $listing->quantity = $item->quantity;
            $listing->discount = $item->discount;
            $listing->price = $item->price;
            array_push($listings, $listing);
        }
        return view('statement.editStatement', [
            'type' => $type,
            'action' => $action,
            'statements' => $statement,
            'client' => $client,
            'listings' => $listings,
            'clients' =>  Client::latest()->get(),
            'olistings' => Listing::all(),
        ]);
    }

    public function update(Request $request, Statement $statement, $type)
    {
        $formFields = $request->validate([
            'client_id' => ['required'],
            'tht' => ['required'],
            'ttc' => ['required'],
            'timbreFiscal' =>[] ,
        ]);
        $total = $this->calculTotal($request, $type);
        $formFields['tht'] = $total['tht'];
        $formFields['ttc'] = $total['ttc'];
        $formFields['gqte'] = array_sum($request->quantity);
        $formFields['tva'] = $total['totalTva'];
        $statement->client_id = $formFields['client_id'];
        if ((!Arr::exists($formFields, 'timbreFiscal') && ($type =='Invoice') )) {
            $formFields['timbreFiscal']= $statement->timbreFiscal;
        }
        if ((!Arr::exists($formFields, 'timbreFiscal') && ($type =='Quote') )) {
            $formFields['timbreFiscal']= 0;
        }
        if ((Arr::exists($formFields, 'timbreFiscal') && ($type =='Invoice') )) {
            $statement->timbreFiscal = $formFields['timbreFiscal'];
        }
        $statement->tht = $formFields['tht'];
        $statement->ttc = $formFields['ttc'];
        $statement->gqte = $formFields['gqte'];
        $statement->tva = $formFields['tva'];
        $statement->update();
        $this->updateItems($request, $statement);
    }

    public function destroy(Statement $statement)
    {
        $statement->delete();
    }

    public function getPDF(Statement $statement, $type, $id)
    {
        $user = Client::find($statement->client_id);
        $statementItems = StatementItem::all()->where('statement_id', $statement->id);

        $listings = array();
        $discounts = array();
        $quantities = array();
        foreach ($statementItems as $item) {
            $quantity = $item->quantity;
            array_push($quantities, $quantity);
            $discount = $item->discount;
            array_push($discounts, $discount);
            $listing = Listing::find($item->listing_id);
            array_push($listings, $listing);
        }
        $table = $this->calculTva($statement);

        $date = date('d/m/Y', strtotime($statement->created_at));
        $filename = $type . '-' . $id . '-' . $user->id . '.pdf';
        $data = [
            'name' => $filename,
            'type' => $type,
            'id' => $id,
            'statement' => $statement,
            'user' => $user,
            'date' => $date,
            'tht' => $statement->tht,
            'ttc' => $statement->ttc,
            'tva' => $statement->tva,
            'Gquantity' => $statement->gqte,
            'listings' => $listings,
            'timbre' => $statement->timbreFiscal,
            'discount' => $discounts,
            'totalDiscount' => $this->calculDiscount($statement),
            'quantity' => $quantities,
            'table' => $table,
        ];

        $pdf = PDF::loadView('statement.statementTemplate', $data);
        return $pdf->stream($filename);
    }

    public function calculDiscount($statement)
    {
        $statementItems = StatementItem::all()->where('statement_id', $statement->id);
        $discount = 0;
        $totalDiscount = 0;
        foreach ($statementItems as $item) {
            $listing = Listing::find($item->listing_id);
            $discount = ($listing->price * $item->quantity * ($item->discount) / 100);
            $totalDiscount = $totalDiscount + $discount;
        }

        return $totalDiscount;
    }

    public function calculTva($statement)
    {
        $statementItems = StatementItem::all()->where('statement_id', $statement->id);
        $table = array();

        foreach ($statementItems as $item) {
            $listing = Listing::find($item->listing_id);
            $amount = ($item->price * $item->quantity) * ($listing->tva) / 100;
            $base = ($item->price * $item->quantity);
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

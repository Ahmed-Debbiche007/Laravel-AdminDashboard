<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Statement;
use App\Models\StatementItem;
use PDF;
use DB;
use PhpParser\PrettyPrinter\Standard;

class StatementController extends Controller
{
    public function index($id, $table, $type)
    {
        $statement = Statement::join($table, 'statements.id','=',$table.'.statement_id')->where('statement_id',$id)->first();
  
        $client = User::find($statement->client_id) ;
    
        $statementItems = StatementItem::all()->where('statement_id','like',$id);
        $listings =array();
        foreach($statementItems as $item){           
            $listing = Listing::find($item->listing_id);
            $listing->quantity = $item->quantity;
            $listing->discount = $item->discount;
            array_push($listings, $listing)   ;         
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
            'clients' =>  user::latest()->where('role', 'like', 'Client')->get(),
            'type' => $type,

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
            $item = new StatementItem();
            $item->statement_id = Statement::latest()->first()->id;
            $item->listing_id = $request->listing[$i];
            $item->quantity = $request->quantity[$i];
            $item->discount = $request->discount[$i];
            $item->save();
         }
    }

    public function updateItems(Request $request, Statement $statement){
        DB::delete('delete from statement_items where statement_id = ?',[$statement->id]);
        for ($i=0; $i< count($request->listing);$i++){
            $item = new StatementItem();
            $item->statement_id = $statement->id;
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

        Statement::create($formFields);
        //$user = User::find($request->client_id);
        $this->createItems($request);       
    }

    public function edit($id, $type)
    {
        $statement = Statement::find($id);
        $client = User::find($statement->client_id) ;
        $statementItems = StatementItem::all()->where('statement_id','like',$id);
        $listings =array();
        foreach($statementItems as $item){           
            $listing = Listing::find($item->listing_id);
            $listing->quantity = $item->quantity;
            $listing->discount = $item->discount;
            array_push($listings, $listing)   ;         
        }
        return view('statement.editStatement', [
            'type' => $type,
            'statements' => $statement,
            'client' => $client,
            'listings' => $listings,
            'clients' =>  user::latest()->where('role', 'like', 'Client')->get(),
            'olistings' => Listing::all(),
        ]);
    }

    public function update(Request $request, Statement $statement)
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
        $statement->client_id = $formFields['client_id'];
        $statement->timbreFiscal = $formFields['timbreFiscal'];
        $statement->tht = $formFields['tht'];
        $statement->ttc = $formFields['ttc'];
        $statement->gqte = $formFields['gqte'];
        $statement->tva = $formFields['tva'];
        $statement->update();
        $this->updateItems($request, $statement);         
    }

    public function destroy(Statement $statement){
        $statement->delete();
    }

    public function getPDF(Statement $statement, $type, $id){
        $user = User::find($statement->client_id);
        $statementItems = StatementItem::all()->where('statement_id',$statement->id);
        
        $listings = array();       
        $discounts = array();
        $quantities = array();
        foreach ($statementItems as $item){
            $quantity = $item->quantity;
            array_push($quantities, $quantity);
            $discount = $item->discount;
            array_push($discounts, $discount);
            $listing = Listing::find($item->listing_id);
            array_push($listings, $listing);
        }
        $table = $this->calculTva($statement);
       
        $date=date('d/m/Y', strtotime($statement->created_at));

        $data=[
            'type' => $type,
            'id' => $id,
            'statement' => $statement,
            'user' => $user,
            'date' => $date,
            'tht' => $statement->tht,
            'ttc' =>$statement->ttc,
            'tva' => $statement->tva,
            'Gquantity' =>$statement->gqte,
            'listings' => $listings,
            'timbre' => $statement->timbreFiscal,
            'discount' => $discounts,
            'totalDiscount' =>$this->calculTotal2($statement),
            'quantity' => $quantities,
            'table' =>$table,
        ];
       
        $pdf = PDF::loadView('statement.statementTemplate', $data);
        $filename = $type.'-'.$statement->id.'-'.$user->id.'.pdf';
        return $pdf->stream($filename);
    }

    public function calculTotal2($statement){
         $statementItems = StatementItem::all()->where('statement_id',$statement->id);
        $discount= 0;
        $totalDiscount=0;
        foreach ($statementItems as $item) {
            $listing = Listing::find($item->listing_id);
            $discount =($listing->price * $item->quantity * ($item->discount) / 100);
            $totalDiscount= $totalDiscount+$discount;
        }

        return $totalDiscount;

    }

    public function calculTva($statement)
    {
        $statementItems = StatementItem::all()->where('statement_id',$statement->id);
        $table = array();

        foreach ($statementItems as $item) {
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

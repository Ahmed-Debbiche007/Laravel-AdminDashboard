<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Statement extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id','timbreFiscal','tht','ttc','gqte','tva',
    ];
    public function scopeFilter ($query, array $filters){
        $route = \Request::route()->getName();

        if ($route == "Quotes"){
        if ($filters['search']??false){

            $query->Where ('quotes.id','like', request('search'))
            ->orWhere ('statements.client_id','like', request('search'))  ;
        }
        }

        if ($route == "Invoices"){
            if ($filters['search']??false){
                $query->Where ('invoices.id','like', request('search')) 
                ->orWhere ('statements.client_id','like', request('search'))  ;
            }
            }

}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'statement_id',
    ];
    public function scopeFilter ($query, array $filters){
        if ($filters['search']??false){
            $query->Where ('invoices.id','like', '%'.request('search').'%')  ;
        }
    }
}

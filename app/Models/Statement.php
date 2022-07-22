<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id','timbreFiscal','tht','ttc','gqte','tva',
    ];
    public function scopeFilter ($query, array $filters){
        if ($filters['search']??false){
            $query->Where ('id','like', '%'.request('search').'%')  ;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'tags', 'photo', 'price','quantity', 'tva',
    ];

    public function scopeFilter ($query, array $filters){
        if ($filters['search']??false){
            $query->Where ('name','like', '%'.request('search').'%')
        ->orWhere ('tags','like', '%'.request('search').'%')
        ->orWhere ('description','like', '%'.request('search').'%')
        ;
        }

        if ($filters['tag']??false){
            $query->Where ('tags','like', '%'.request('tag').'%')
        ;
        }
    }

}

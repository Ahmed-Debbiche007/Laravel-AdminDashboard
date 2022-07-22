<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatementItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'statement_id','listing_id','discount','quantity',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageDetail extends Model
{
    protected $fillable = [
        'case_id', 
        'contract_date', 
        'document_number', 
        'authority', 
        'dowry', 
        'deferred_dowry',
        'guardian',
        'place',
        'consummation_status'
    ];
}

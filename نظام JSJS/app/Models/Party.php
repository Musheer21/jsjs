<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = ['case_id', 'type', 'full_name', 'occupation', 'address', 'phone'];
}

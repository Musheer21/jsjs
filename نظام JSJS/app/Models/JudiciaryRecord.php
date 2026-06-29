<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudiciaryRecord extends Model
{
    protected $fillable = ['full_name', 'national_id', 'status'];
}

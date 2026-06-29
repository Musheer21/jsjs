<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    protected $table = 'cases';
    protected $fillable = ['case_number', 'case_type', 'facts', 'legal_reasons', 'status', 'judge_name', 'attachment_path', 'attachment_content'];


    protected $casts = [
        'legal_reasons' => 'array',
    ];

    public function parties()
    {
        return $this->hasMany(Party::class, 'case_id');
    }
    public function marriageDetail()
    {
        return $this->hasOne(MarriageDetail::class, 'case_id');
    }
    public function children()
    {
        return $this->hasMany(Child::class, 'case_id');
    }
    public function financialClaim()
    {
        return $this->hasOne(FinancialClaim::class, 'case_id');
    }
    public function witnesses()
    {
        return $this->hasMany(Witness::class, 'case_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtaApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'dta_id',
        'approved_by_supervisor',
        'approved_by_unit_head',
        'approved_by_hod',
        'approved_by_accountant'
    ];

    public function dtaRequest()
    {
        return $this->belongsTo(Dta::class);
    }
}

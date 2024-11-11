<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorPaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractor_id',
        'project_id',
        'contract_id',
        'amount_paid',
        'payment_date',
        'remarks',
        'remaining_balance'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}

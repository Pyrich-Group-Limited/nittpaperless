<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorPaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_request_id',
        'contractor_id',
        'project_id',
        'contract_id',
        'amount_paid',
        'payment_date',
        'remarks',
        'remaining_balance',
        'processed_by'
    ];

    public function paymentRequest()
    {
        return $this->belongsTo(PaymentRequest::class,'payment_request_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class,'contract_id');
    }
}

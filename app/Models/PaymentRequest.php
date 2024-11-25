<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id', 'recommended_amount', 'recommended_percentage', 'recommended_by',
        'approved_by', 'signed_by', 'voucher_raised_by', 'audited_by', 'status', 'remarks', 'isCompleted',
        'account_id',
        'payment_evidence'
    ];

    public function paymentHistories()
    {
        return $this->hasMany(ContractorPaymentHistory::class);
    }

    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class,'account_id');
    }

    // public function contractorPaymentHistory()
    // {
    //     return $this->hasOne(ContractorPaymentHistory::class, 'payment_request_id');
    // }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function recommendedBy()
    {
        return $this->belongsTo(User::class, 'recommended_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function signedBy()
    {
        return $this->belongsTo(User::class, 'signed_by');
    }

    public function vourcherRaisedBy()
    {
        return $this->belongsTo(User::class, 'voucher_raised_by');
    }

    public function auditedBy()
    {
        return $this->belongsTo(User::class, 'audited_by');
    }
}

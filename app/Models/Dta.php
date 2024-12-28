<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination',
        'purpose',
        'travel_date',
        'arrival_date',
        'estimated_expense',
        'current_approver',
        'department_id',
        'unit_id',
        'status',
        'account_id',
        'payment_evidence',
        'location',
        'supporting_document'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function approval()
    // {
    //     return $this->hasOne(DtaApproval::class);
    // }

    public function approvalRecords()
    {
        return $this->hasMany(DtaApproval::class,'dta_id');
    }

    public function rejectionComment()
    {
        return $this->hasOne(DtaRejectionComment::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // public function liaisonOffice()
    // {
    //     return $this->belongsTo(LiasonOffice::class);
    // }

    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }
}

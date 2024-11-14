<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRequisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'requisition_type',
        'purpose',
        'description',
        'amount',
        'status',
        'department_id',
        'supporting_document',
        'account_id',
        'payment_evidence'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class);
    }

    // public function signature()
    // {
    //     return $this->hasOne(Signature::class,'user_id');
    // }

    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }

    public function approvalRecords()
    {
        return $this->hasMany(RequisitionApprovalRecord::class,'requisition_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

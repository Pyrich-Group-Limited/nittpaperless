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
        'supporting_document'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionApprovalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'approver_id',
        'role',
        'status',
        'comment',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class,'approver_id');
    }

    public function staffRequisition()
    {
        return $this->belongsTo(StaffRequisition::class,'requisition_id');
    }

    public function requisition()
    {
        return $this->hasMany(StaffRequisition::class);
    }
}

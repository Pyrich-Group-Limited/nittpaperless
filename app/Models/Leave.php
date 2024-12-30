<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'department_id',
        'unit_id',
        'applied_on',
        'start_date',
        'end_date',
        'total_leave_days',
        'leave_reason',
        'supporting_document',
        'remark',
        'status',
        'current_approver',
        'created_by',
        'relieving_staff_id'
    ];

    public function relieveStaff(){
        return $this->belongsTo(User::class,'relieving_staff_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function approvals() {
        return $this->hasMany(LeaveApproval::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'approver_id',
        'approval_stage',
        'type',
        'status',
    ];

    public function leave() {
        return $this->belongsTo(Leave::class);
    }

    public function approver() {
        return $this->belongsTo(User::class, 'approver_id');
    }
}

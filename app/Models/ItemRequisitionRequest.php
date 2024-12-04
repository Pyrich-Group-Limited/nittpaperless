<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisitionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'department_id', 'status',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function items()
    {
        return $this->hasMany(ItemRequisitionList::class,'item_requisition_request_id');
    }

    public function approvals()
    {
        return $this->hasMany(ItemRequisitionApproval::class, 'item_requisition_request_id');
    }

}

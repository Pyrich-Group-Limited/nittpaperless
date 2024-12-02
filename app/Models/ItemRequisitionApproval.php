<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisitionApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_requisition_request_id', 'approved_by', 'role', 'comments', 'status',
    ];

    public function itemRequest()
    {
        return $this->belongsTo(ItemRequisitionRequest::class);
    }
}

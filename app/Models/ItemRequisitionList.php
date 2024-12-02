<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisitionList extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_requisition_request_id', 'item_name', 'description','quantity_requested','quantity_available',
        'status','acknowledged',
    ];

    public function itemRequest()
    {
        return $this->belongsTo(ItemRequisitionRequest::class);
    }

}

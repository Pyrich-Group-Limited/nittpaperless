<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequisitionList extends Model
{
    use HasFactory;


    protected $fillable = [
        'item_name',
        'purchase_requisitions_id',
        'description',
        'quantity_requested',
        'quantity_available',
        'acknowledged',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function requisition(){
        return $this->belongsTo(PurchaseRequisition::class);
    }
}

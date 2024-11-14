<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisitionApproval extends Model
{
    use HasFactory;

    public function itemRequest()
    {
        return $this->belongsTo(ItemRequisitionRequest::class);
    }
}

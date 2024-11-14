<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisitionRequest extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(ItemRequisitionList::class);
    }

    public function approval()
    {
        return $this->hasOne(ItemRequisitionApproval::class);
    }

}

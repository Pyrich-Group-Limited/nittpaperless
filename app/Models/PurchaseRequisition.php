<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'last_date',
        'status',
        'approval_status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(PurchaseRequisitionList::class,'purchase_requisitions_id');
    }


    protected $casts = [
        'last_date' => 'datetime',
    ];

}

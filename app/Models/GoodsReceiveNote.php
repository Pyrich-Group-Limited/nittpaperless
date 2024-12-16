<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceiveNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'supplier_name',
        'comment',
        'invoice_no',
        'user_id',
    ];

    public function project(){
        return $this->belongsTo(ProjectCreation::class);
    }

    public function items(){
        return $this->hasMany(ProjectSupplyHistory::class,'goods_receive_notes_id');
    }



}

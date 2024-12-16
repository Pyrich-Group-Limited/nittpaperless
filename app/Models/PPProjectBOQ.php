<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPProjectBOQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'unit_price',
        'item',
        'description',
        'status',
        'quantity',
        'total',
        'remaining_balance'
    ];

    public function project(){
        return $this->belongsTo(ProjectCreation::class,'project_id');
    }


    public function supplied(){
        return $this->hasMany(ProjectSupplyHistory::class,'item_id');
    }

    // public function getBalanceAttribute()
    // {
    //     return $this->unit_price * $this->quantity;
    // }
}

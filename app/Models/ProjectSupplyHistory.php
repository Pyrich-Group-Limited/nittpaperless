<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSupplyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'item_id',
        'user_id',
        'quantity',
        'goods_receive_notes_id',
    ];

    public function project(){
        return $this->belonsgTo(ProjectCreation::class);
    }

    public function item(){
        return $this->belongsTo(PPProjectBOQ::class,'item_id');
    }

}

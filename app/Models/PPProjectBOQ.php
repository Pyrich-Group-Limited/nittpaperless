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
    ];

    public function project(){
        return $this->belongsTo(ProjectCreation::class,'project_id');
    }
}

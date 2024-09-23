<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subunit extends Model
{
    use HasFactory;


    protected $fillalbe = [
        'name',
        'unit_id'
    ];

    public function subunit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
}

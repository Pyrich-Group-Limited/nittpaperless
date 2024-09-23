<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillalbe = [
        'name',
        'department_id'
    ];

    public function subunits(){
        return $this->hasMany(Subunit::class);
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
}

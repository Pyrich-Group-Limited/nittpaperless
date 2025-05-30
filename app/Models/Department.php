<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'category',
        'created_by',
    ];

    public function branch(){
        return $this->hasOne('App\Models\Branch','id','branch_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function units(){
        return $this->hasMany(Unit::class);
    }

    public function leaveApprovals()
    {
        return $this->hasMany(LeaveApproval::class);
    }
}

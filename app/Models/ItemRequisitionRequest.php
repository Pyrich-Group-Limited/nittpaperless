<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisitionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'department_id', 'status',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function items()
    {
        return $this->hasMany(ItemRequisitionList::class);
    }

    public function approval()
    {
        return $this->hasOne(ItemRequisitionApproval::class);
    }

}

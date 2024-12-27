<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'raised_by',
        'subject',
        'staff_id',
        'query_details',
        'attachment',
        'status',
        'assigned_by',
    ];

    public function raiser()
    {
        return $this->belongsTo(User::class, 'raised_by');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function answers()
    {
        return $this->hasOne(QueryAnswer::class);
    }
}

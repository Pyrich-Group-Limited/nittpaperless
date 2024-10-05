<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dta extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
        'destination',
        'purpose',
        'travel_date',
        'arrival_date',
        'estimated_expense',
        'current_approver'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approval()
    {
        return $this->hasOne(DtaApproval::class);
    }

    public function rejectionComment()
    {
        return $this->hasOne(DtaRejectionComment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DtaRejectionComment extends Model
{
    use HasFactory;

    protected $fillable = ['dta_id', 'rejected_by', 'comment'];

    public function dtaRequest()
    {
        return $this->belongsTo(Dta::class);
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}

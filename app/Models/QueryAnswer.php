<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'query_id',
        'staff_id',
        'answer',
        'supporting_documents',
        'signature',
        'answered_at',
    ];

    public function dQuery()
    {
        return $this->belongsTo(Query::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}

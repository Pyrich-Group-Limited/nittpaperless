<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobberApplicationNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'note_created',
        'note',
        'created_by',
    ];

    public function noteCreated()
    {
        return $this->hasOne('App\Models\User', 'id', 'note_created');
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobberApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobber',
        'name',
        'email',
        'phone',
        'profile',
        'resume',
        'cover_letter',
        'dob',
        'gender',
        'country',
        'state',
        'city',
        'stage',
        'order',
        'skill',
        'rating',
        'is_archive',
        'custom_question',
        'created_by',
    ];

    public function jobbers()
    {
        return $this->hasOne('App\Models\Jobber', 'id', 'jobber');
    }
}

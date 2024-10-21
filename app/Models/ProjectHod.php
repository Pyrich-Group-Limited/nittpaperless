<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectHod extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'hod_id'
    ];

    // A ProjectHod belongs to a project
    public function project()
    {
        return $this->belongsTo(ProjectCreation::class,'project_id');
    }

    // A ProjectHod belongs to a hod (user)
    public function hod()
    {
        return $this->belongsTo(User::class, 'hod_id');
    }
}

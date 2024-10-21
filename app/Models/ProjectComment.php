<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    use HasFactory;

    protected $fillable = ['project_creation_id', 'user_id', 'content'];

    public function project()
    {
        return $this->belongsTo(ProjectCreation::class,'project_creation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

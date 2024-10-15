<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    use HasFactory;

    // A category has many projects
    public function projects()
    {
        return $this->hasMany(ProjectCreation::class);
    }

    public function ergp()
    {
        return $this->hasOne(Ergp::class,'project_category_id');
    }
}

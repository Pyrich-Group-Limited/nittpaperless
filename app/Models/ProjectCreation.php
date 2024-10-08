<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCreation extends Model
{
    use HasFactory;

    // A project belongs to one category
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    // A project has many adverts
    public function adverts()
    {
        return $this->hasMany(ProjectAdvert::class);
    }
}

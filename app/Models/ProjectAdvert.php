<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAdvert extends Model
{
    use HasFactory;

     // A project advert belongs to a project
     public function project()
     {
         return $this->belongsTo(ProjectCreation::class);
     }

     // A project advert has many applications
     public function applications()
     {
         return $this->hasMany(ProjectApplication::class);
     }
}

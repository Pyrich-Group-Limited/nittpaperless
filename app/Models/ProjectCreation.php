<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCreation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'description',
        'start_date',
        'end_date',
        'project_category_id',
        'project_boq',
        'supervising_staff_id',
        'status',
        'budget',
        'created_by'
    ];

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

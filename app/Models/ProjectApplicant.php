<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'year_of_incoperation',
        'company_tin',
        'company_address',
        'email',
        'user_id',
        'phone',
    ];

    // Applicant details belong to one project application (One-to-One)
    public function application()
    {
        return $this->hasMany(ProjectApplication::class, 'user_id', 'user_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'user_id');
    // }

    // Applicant details belong to one project application (One-to-One)
    // public function application()
    // {
    //     return $this->belongsTo(ProjectApplication::class,'project_applications');
    // }

    // public function projects()
    // {
    //     return $this->belongsToMany(ProjectCreation::class);
    // }
}

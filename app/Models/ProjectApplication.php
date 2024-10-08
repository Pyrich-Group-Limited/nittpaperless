<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApplication extends Model
{
    use HasFactory;

    // A project application belongs to a project advert
    public function advert()
    {
        return $this->belongsTo(ProjectAdvert::class);
    }

    // A project application has one applicant details (One-to-One)
    public function applicantDetails()
    {
        return $this->hasOne(ProjectApplicant::class);
    }

    // A project application has many document uploads (One-to-Many)
    public function documentUploads()
    {
        return $this->hasMany(ProjectApplicationDocument::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApplicant extends Model
{
    use HasFactory;

    // Applicant details belong to one project application (One-to-One)
    public function application()
    {
        return $this->belongsTo(ProjectApplication::class);
    }
}

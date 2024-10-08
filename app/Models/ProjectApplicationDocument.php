<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApplicationDocument extends Model
{
    use HasFactory;

    // document upload belongs to one project application
    public function application()
    {
        return $this->belongsTo(ProjectApplication::class);
    }
}

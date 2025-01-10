<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_application_id',
        'document_name',
        'document',
        'user_id',
    ];

    // document upload belongs to one project application
    public function application()
    {
        return $this->belongsTo(ProjectApplication::class,'project_application_id');
    }

    public function getDocumentUrlAttribute()
    {
        return asset('storage/' . $this->document);
    }
}

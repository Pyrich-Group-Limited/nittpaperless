<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'path', 'user_id', 'folder_id',
    'department_id', 'unit_id', 'location_type','visibility',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'file_user')
        ->withPivot(['sharer_id', 'priority', 'created_at'])->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // public function pivotSharer()
    // {
    //     return $this->belongsTo(User::class, 'sharer_id');
    // }

}

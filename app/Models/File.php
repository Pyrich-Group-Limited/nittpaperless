<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'path', 'user_id', 'folder_id'];

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
        ->withPivot('sharer_id', 'priority', 'created_at')->withTimestamps();
    }

    // The employee who shared the memo
    // public function sharedBy()
    // {
    //     return $this->belongsTo(User::class);
    // }


}

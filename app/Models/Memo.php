<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = ['created_by', 'title', 'description', 'file_path'];

    // The employee who created the memo
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Employees the memo has been shared with
    public function shares()
    {
        return $this->hasMany(MemoShare::class);
    }

    // Comments on the memo
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function signedUsers()
    {
        return $this->belongsToMany(User::class, 'memo_signatures')
                    ->withTimestamps();
    }
}

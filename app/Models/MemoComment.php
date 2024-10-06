<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoComment extends Model
{
    use HasFactory;

    protected $fillable = ['memo_id', 'user_id', 'comment'];

    // The memo the comment belongs to
    public function memo()
    {
        return $this->belongsTo(Memo::class);
    }

    // The employee who made the comment
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

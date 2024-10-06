<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoShare extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['memo_id', 'shared_with', 'shared_by', 'comment'];

    // The memo being shared
    public function memo()
    {
        return $this->belongsTo(Memo::class);
    }

    // The employee who received the shared memo
    public function sharedWith()
    {
        return $this->belongsTo(User::class, 'shared_with');
    }

    // The employee who shared the memo
    public function sharedBy()
    {
        return $this->belongsTo(User::class, 'shared_by');
    }
}

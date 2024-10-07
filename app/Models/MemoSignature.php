<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoSignature extends Model
{
    use HasFactory;

    protected $fillable = ['memo_id', 'user_id'];

    // Memo that has been signed
    public function memo()
    {
        return $this->belongsTo(Memo::class);
    }

    // User who signed the memo
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

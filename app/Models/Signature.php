<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'signature_path'];

    // The employee's signature
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hrmdocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'path',
        'user_id',
        'hrmfolders_id',
        'is_archived',
    ];

    public function owner(){
        return $this->belongsTo(User::class);
    }


    public function folder(){
        return $this->belongsTo(Hrmfolder::class,'hrmfolders_id');
    }
}

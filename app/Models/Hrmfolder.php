<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hrmfolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'sub_folder_id',
        'folder_type',
        'user_id',
        'folder_name',
        'status',
    ];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function folder(){
        return $this->belongsTo(Hrmfolder::class);
    }

    public function folders(){
        return $this->hasMany(Hrmfolder::class);
    }
}

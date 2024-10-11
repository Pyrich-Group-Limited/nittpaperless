<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ergp extends Model
{
    use HasFactory;

    protected $table = 'ergps';

    protected $fillable = [
        'project_category_id',
        'code',
        'title',
        'year',
        'project_sum',
        'amount_paid',
        'deficit',
    ];


    public function projectCategory(){
        return $this->belongsTo(projectCategory::class,'project_category_id');
    }

    /**
     * Accessor to calculate balance as a dynamic attribute
     */
    public function getBalanceAttribute()
    {
        return $this->project_sum - $this->amount_paid;
    }
}

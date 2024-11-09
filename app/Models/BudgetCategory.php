<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'chart_of_account_id',
        'name',
        'total_amount',
        'remaining_amount',
        'deficit',
        'status',
        'year'
    ];

    // One-to-Many relationship with DepartmentBudget
    public function departmentBudgets()
    {
        return $this->hasMany(DepartmentBudget::class);
    }

    public function chartOfAccounts(){
        return $this->belongsTo(ChartOfAccount::class,'chart_of_account_id');
    }
}

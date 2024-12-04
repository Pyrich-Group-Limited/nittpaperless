<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_budget_id','quantity', 'description', 'amount'
    ];

    // Belongs to a specific DepartmentBudget
    public function departmentBudget()
    {
        return $this->belongsTo(DepartmentBudget::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_amount',
        'remaining_amount',
        'status'
    ];

    // One-to-Many relationship with DepartmentBudget
    public function departmentBudgets()
    {
        return $this->hasMany(DepartmentBudget::class);
    }
}

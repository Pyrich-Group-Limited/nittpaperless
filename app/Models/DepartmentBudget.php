<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_category_id', 'department_id', 'total_requested', 'user_id', 'status', 'comment'
    ];

    // Belongs to a specific BudgetCategory
    public function budgetCategory()
    {
        return $this->belongsTo(BudgetCategory::class);
    }

    // One-to-Many relationship with BudgetItem
    public function items()
    {
        return $this->hasMany(BudgetItem::class);
    }

    // Belongs to a specific Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

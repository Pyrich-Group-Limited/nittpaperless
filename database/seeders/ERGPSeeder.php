<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ergp;
use App\Models\ProjectCategory;

class ERGPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectCategories = ProjectCategory::all();

        Ergp::create([
            'project_category_id' => $projectCategories->where('category_name','Supply')->first()->id,
            'code' => 'ERGP/2024/001',
            'title' => 'ERGP for Supply',
            'year' => 2024,
            'project_sum' => 1000000.00,
            'amount_paid' => 0.00,
            'deficit' => 0.00,
        ]);

        Ergp::create([
            'project_category_id' => $projectCategories->where('category_name','Service')->first()->id,
            'code' => 'ERGP/2024/002',
            'title' => 'ERGP for Services',
            'year' => 2024,
            'project_sum' => 500000.00,
            'amount_paid' => 0.00,
            'deficit' => 0.00,
        ]);

        Ergp::create([
            'project_category_id' => $projectCategories->where('category_name','Works')->first()->id,
            'code' => 'ERGP/2024/003',
            'title' => 'ERGP for works',
            'year' => 2024,
            'project_sum' => 1500000.00,
            'amount_paid' => 0.00,
            'deficit' => 0.00,
        ]);

    }
}

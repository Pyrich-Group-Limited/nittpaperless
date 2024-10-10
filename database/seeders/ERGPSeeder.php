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
            'year' => 2024,
            'project_sum' => 1000000.00,
            'amount_paid' => 600000.00,
            'deficit' => 0.00,
        ]);

        Ergp::create([
            'project_category_id' => $projectCategories->where('category_name','Service')->first()->id,
            'year' => 2024,
            'project_sum' => 500000.00,
            'amount_paid' => 300000.00,
            'deficit' => 0.00,
        ]);

        Ergp::create([
            'project_category_id' => $projectCategories->where('category_name','Works')->first()->id,
            'year' => 2024,
            'project_sum' => 1500000.00,
            'amount_paid' => 1400000.00,
            'deficit' => 0.00,
        ]);

    }
}

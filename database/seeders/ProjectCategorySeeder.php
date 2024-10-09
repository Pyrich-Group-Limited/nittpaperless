<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectCategory::create([
            'category_name' => 'Supply',
        ]);
        ProjectCategory::create([
            'category_name' => 'Service',
        ]);
        ProjectCategory::create([
            'category_name' => 'Works',
        ]);
    }
}

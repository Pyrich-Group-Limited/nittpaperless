<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobCategory;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobCategory::create([
            'title' => 'Full-time',
            'created_by' => 1
        ]);
        JobCategory::create([
            'title' => 'Part-time',
            'created_by' => 1
        ]);
        JobCategory::create([
            'title' => 'Apprenticeship',
            'created_by' => 1
        ]);
        JobCategory::create([
            'title' => ' Internship',
            'created_by' => 1
        ]);
    }
}

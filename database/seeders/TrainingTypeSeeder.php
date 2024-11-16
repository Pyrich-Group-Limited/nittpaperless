<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrainingType;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingType::create([
            'name' => 'Safety Training',
            'created_by' => 1
        ]);
        TrainingType::create([
            'name' => 'Quality Assurance',
            'created_by' => 1
        ]);
        TrainingType::create([
            'name' => 'Employee Training',
            'created_by' => 1
        ]);
        TrainingType::create([
            'name' => 'Leadership Training',
            'created_by' => 1
        ]);
        TrainingType::create([
            'name' => 'Internship Training',
            'created_by' => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCreation;
use App\Models\ProjectAdvert;

class ProjectAdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = ProjectCreation::all();

        ProjectAdvert::create([
            'project_id' => $projects->where('advert_approval_status',true)->first()->id,
            'advert_type' => 'External',
            'description' => 'displays all the contractors that applied for the selected project.',
            'start_date' => '2024-10-14',
            'end_date' => '2024-10-26'
        ]);
    }
}

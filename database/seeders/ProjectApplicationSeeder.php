<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectApplication;
use App\Models\ProjectAdvert;
use App\Models\User;
use App\Models\ProjectApplicant;

class ProjectApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = ProjectAdvert::all();

        $user = User::all();

        $projectApp = ProjectApplication::create([
            'project_id' => $project->first()->project_id,
            'user_id' => $user->where('type','contractor')->first()->id,
            'application_status' => 'pending'
        ]);

        ProjectApplicant::create([
            'user_id' => $projectApp->user_id,
            'company_name' => 'Kamzone IT',
            'year_of_incorporation' => '2020',
            'company_tin' => '29302392',
            'company_address' => 'Utako Abuja',
            'email' => 'kamzone@gmail.com',
            'phone' => '08012341234'
        ]);
    }
}

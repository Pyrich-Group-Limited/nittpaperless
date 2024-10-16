<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCreation;
use App\Models\ProjectCategory;
use App\Models\ProjectUser;
use App\Models\User;

class ProjectCreationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectCategories = ProjectCategory::all();
        $staff = User::where('type','!=','Contractor')->get();

        $project = ProjectCreation::create([
            'project_name' => 'Supply and Installation of Solar street light',
            'projectId' => 'NITT/SPL/LOT/001',
            'description' => 'Supply and Installation of Solar street light',
            'start_date' => '',
            'end_date' => '',
            'project_category_id' => $projectCategories->where('category_name','Supply')->first()->id,
            'project_boq' => '',
            'supervising_staff_id' => $staff->where('type','user')->first()->id,
            'status' => 'pending',
            'budget' => '',
            'advert_approval_status' => false,
            'created_by' => $staff->where('type','super admin')->first()->id,
        ]);
        ProjectUser::create([
            'project_id' => $project->id,
            'user_id' => $project->supervising_staff_id,
            'invited_by' => 0
        ]);

        $project = ProjectCreation::create([
            'project_name' => 'Construction banquet hall',
            'projectId' => 'NITT/WRK/LOT/002',
            'description' => 'COnstruction of a 5000 capacity banquet hall',
            'start_date' => '',
            'end_date' => '',
            'project_category_id' => $projectCategories->where('category_name','Works')->first()->id,
            'project_boq' => '',
            'supervising_staff_id' => $staff->where('type','user')->first()->id,
            'status' => 'pending',
            'budget' => '',
            'advert_approval_status' => false,
            'created_by' => $staff->where('type','super admin')->first()->id,
        ]);
        ProjectUser::create([
            'project_id' => $project->id,
            'user_id' => $project->supervising_staff_id,
            'invited_by' => 0
        ]);

        $project = ProjectCreation::create([
            'project_name' => 'Software development',
            'projectId' => 'NITT/SRV/LOT/003',
            'description' => 'the development and an e-library software for the institution',
            'start_date' => '',
            'end_date' => '',
            'project_category_id' => $projectCategories->where('category_name','Service')->first()->id,
            'project_boq' => '1728813908.fJn0ST7rAFRy2SRhOjHDAguKTg3gEyTaG5ChelOh.pdf',
            'supervising_staff_id' => $staff->where('type','user')->first()->id,
            'status' => 'pending',
            'budget' => 11345670,
            'advert_approval_status' => true,
            'created_by' => $staff->where('type','super admin')->first()->id,
        ]);
        ProjectUser::create([
            'project_id' => $project->id,
            'user_id' => $project->supervising_staff_id,
            'invited_by' => 0
        ]);
    }
}

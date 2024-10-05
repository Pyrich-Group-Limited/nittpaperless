<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveSeeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveType::create([
            'title' => "Annual Leave",
            'days' => 30
        ]);

        LeaveType::create([
            'title' => "Casual Leave",
            'days' => 7
        ]);

        LeaveType::create([
            'title' => "Sick Leave",
            'days' => 15
        ]);


        LeaveType::create([
            'title' => "Maternity Leave",
            'days' => 112
        ]);

        LeaveType::create([
            'title' => "Paternity Leave",
            'days' => 14
        ]);


        LeaveType::create([
            'title' => "Compassionate/Bereavement Leave",
            'days' => 10
        ]);


        LeaveType::create([
            'title' => "Study/Education Leave",
            'days' => 365
        ]);
    }
}

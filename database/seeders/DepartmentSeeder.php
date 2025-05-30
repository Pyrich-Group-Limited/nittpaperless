<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Unit;
use App\Models\Subunit;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = Department::create([
            'name' => "Bursary Department",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Budget and Planing Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Revenue Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Asset Management & C.L.O Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Stores"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Personnel Emolument Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Loan and Advances"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Expenditure Control Unit"
            ]);


        $department = Department::create([
            'name' => "Registry Department",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Personel Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Academic Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Administrative Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Students Affairs Unit"
            ]);

        $department = Department::create([
            'name' => "Audit Department",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Prepayment Audit Unit"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Post-Payment Audit Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Store and Inspection Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Revenue Unit"
            ]);

        $department = Department::create([
            'name' => "Library and Information Department",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Software Development Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Internet and Intranet Infrastructure Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Maintenance Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Library Unit"
            ]);

        $department = Department::create([
            'name' => "Consultancy Department",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "To Be Provided"
            ]);

        $department = Department::create([
            'name' => "Transport, Research and Intelligence",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Transport Research Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Transport Intelligence Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Databank Unit"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Journal Publications Unit"
            ]);

        $department = Department::create([
            'name' => "Transport School Department",
            'category' => "department",
        ]);

            $unit = Unit::create([
                'department_id' => $department->id,
                'name' => "Administrative unit"
            ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Students Affairs"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Distance Learning"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Facilities and Equipment "
                ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Examination Unit"
            ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Post Graduate Programs (with ABU)"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Masters in Transport & Logistics MTL"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Postgraduate Diploma in Transport & Logistics PGDTL"
                ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "NITT Programs"
            ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Professional Certificate in Transport & Logistics PCTL"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Professional Diploma in Transport & Logistics PDTL"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Professional Advanced Diploma in Transport & Logistics PADTL"
                ]);


            Unit::create([
                'department_id' => $department->id,
                'name' => "NBTE Programs"
            ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "National Diploma ND"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "National Innovation Diploma NID"
                ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Higher National Diploma HND"
                ]);

        $department = Department::create([
            'name' => "Transport Technology Center Department",
            'category' => "department",
        ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Environmental and Energy Engineering"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Civil and Highway Engineering"
            ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Electrical and Electronics Engineering"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Mechatronics Engineering"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Welding and Fabrication Engineering"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Health and Safety"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Computer and ICT"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Shipping and Logistics"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Driving Academy"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Skill Acquisition and Entrepreneurship"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "National Vocational Certificate"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Multi-Lingual"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Laboratories"
            ]);

                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Environmental Engineering Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => " Renewable Energy Engineering Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Civil and Highway Engineering Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Health and Safety Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "  Computer and ICT Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => " Multilingual Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Design Studio Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => " Dynamometer Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Artificial Intelligence/ UAV"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Simulator Laboratory"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Dynamometer Laboratory"
                ]);

            Unit::create([
                'department_id' => $department->id,
                'name' => "Workshops"
            ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => " Mechatronics Workshop"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Welding and Fabrication Workshop"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Electrical and Electronics Workshop"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Autobody Workshop"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Refrigeration and Air Conditioning Workshop"
                ]);
                Subunit::create([
                    'unit_id' => $unit->id,
                    'name' => "Machine Tools"
                ]);

        $department = Department::create([
            'name' => "DG's Office",
            'category' => "department",
        ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Procurement Unit"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Physical Planing Unit"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Legal"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Servicom"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Special Duty"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Annexes"
            ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "DG's Office"
            ]);

        $department = Department::create([
            'name' => "ICT Department",
            'category' => "department",
        ]);
            Unit::create([
                'department_id' => $department->id,
                'name' => "Software Unit"
            ]);
    }
}

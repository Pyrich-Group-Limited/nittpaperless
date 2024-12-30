<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LiasonOffice;
class LiasonOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiasonOffice::create([
            'name' =>'Abuja'
        ]);

        LiasonOffice::create([
            'name' =>'Kano'
        ]);

        LiasonOffice::create([
            'name' =>'Portharcourt'
        ]);

        LiasonOffice::create([
            'name' =>'Gombe'
        ]);


        LiasonOffice::create([
            'name' =>'Ebonyi'
        ]);

        LiasonOffice::create([
            'name' =>'Katsina'
        ]);

        LiasonOffice::create([
            'name' =>'Ekiti'
        ]);

        LiasonOffice::create([
            'name' =>'Lagos'
        ]);
        LiasonOffice::create([
            'name' =>'Kaduna'
        ]);
        LiasonOffice::create([
            'name' =>'Enugu'
        ]);
    }
}

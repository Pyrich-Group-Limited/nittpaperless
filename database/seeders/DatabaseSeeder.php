<?php

namespace Database\Seeders;

use App\Models\Utility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NotificationSeeder::class);
        Artisan::call('module:migrate LandingPage');
        Artisan::call('module:seed LandingPage');

       /*  if(\Request::route()->getName()!='LaravelUpdater::database')
        { */
            $this->call(DesignationSeeder::class);
            $this->call(DepartmentSeeder::class);
            $this->call(UsersTableSeeder::class);
            $this->call(AiTemplateSeeder::class);
            $this->call(LeaveSeeader::class);
            $this->call(LiasonOfficerSeeder::class);
            $this->call(ProjectCategorySeeder::class);
            $this->call(ERGPSeeder::class);

       /*  }else{
            Utility::languagecreate();

        } */

    }
}

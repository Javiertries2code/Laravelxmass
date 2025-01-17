<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);

        $this->call(class:UserSeeder::class);


        $this->call(SubjectSeeder::class);

        $this->call(CourseSeeder::class);
        //$this->call(CourseSubjectSeeder::class);
        $this->call(StudentScheduleSeeder::class);
        $this->call(RegistrationSeeder::class);

        $this->call(UserFixedTest::class);
       $this->call(TeacherScheduleSeeder::class);




    }
}

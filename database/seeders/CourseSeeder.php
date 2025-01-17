<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $courses = [
            ['code' => 'curso 1', 'name' => "DAM"],
            ['code' => 'curso 2', 'name' => "DAO"],
            ['code' => 'curso 3', 'name' => "Sistemas"],
            ['code' => 'curso 4', 'name' => "WEB"],
            ['code' => 'curso 5', 'name' => "Cyber Seguridad"]
        ];



        DB::table('courses')->insert($courses);

        $courses = Course::all();
        $subjects = \App\Models\Subject::all();

        // foreach ($courses as $course) {
        //     $coursesubjects = $subjects->random(6);
        //     $course->subjects()->attach($coursesubjects);
        // }

}
}

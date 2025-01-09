<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;


class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $nulos = [null];
        $students = User::where('user_type', 'student')->get();


        foreach ($students as $student) {
            $randomCourses = $courses->shuffle()->take(2);
            $randomCourses = $randomCourses->concat(collect($nulos));
            $randomCourses = $randomCourses->shuffle()->take(2);
            //I do all this to try to put random null, so not all students have two registrations

            foreach ($randomCourses as $randomCourse) {
                if ($randomCourse !== null) {
                    $newRegistration = [
                        'student_id' => $student->id,
                        'course_id' => $randomCourse->id,
                        'day'=>now()
                    ];

                    DB::table('registrations')->insert($newRegistration);
                }
            }
        }
    }
}

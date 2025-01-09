<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;




class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('type_user', 'teacher')->get();
        $days_week = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];

        $courses = collect();
        $subjects = collect();
        $randomCourses = collect();
        $randomSubjects = collect();
        $allItems = collect();
        $nulos = [null, null, null];
        foreach ($teachers as $teacher) {
            Course::with('subjects')->get();
            $randomCourses = $courses->shuffle()->take(3);
            foreach ($courses as $course) {


                $subjects = $course->subjects;
                foreach ($days_week as $day) {


                 $randomSubjects= $subjects->merge($nulos)->shuffle()->take(6);

                //i mix with nulles to produce empty free hours

                $student_sh = [
                    'day_week' => $day,
                    'hour_1' => $randomSubjects[0]->id,
                    'hour_2' => $randomSubjects[1]->id,
                    'hour_3' => $randomSubjects[2]->id,
                    'hour_4' => $randomSubjects[3]->id,
                    'hour_5' => $randomSubjects[4]->id,
                    'hour_6' => $randomSubjects[5]->id
                ];
                DB::table('schedules')->insert($student_sh);}
            }


            }
        }
    }

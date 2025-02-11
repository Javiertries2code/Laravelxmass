<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;



class StudentScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::with('subjects')->get();
        $subjects = collect();
        $days_week = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];

        foreach ($courses as $course) {
            //$subjects = $subjects->merge($course->subjects);
            $subjects = $course->subjects;

            $randomSubjects = $subjects->shuffle(); //baraja
            $randomSubjects2 = $subjects->shuffle(); //baraja




            // take 6, ofc
            $randomSubjects = $randomSubjects->take(6);
            if ($randomSubjects->count() > 0) {

                foreach ($days_week as $day) {

                    $student_sh = [
                        'course_id' => $course->id,
                        'day_week' => $day,
                        'hour_1' => $randomSubjects[0]->id,
                        'hour_2' => $randomSubjects[1]->id,
                        'hour_3' => $randomSubjects[2]->id,
                        'hour_4' => $randomSubjects[3]->id,
                        'hour_5' => $randomSubjects[4]->id,
                        'hour_6' => $randomSubjects[5]->id
                    ];
                    DB::table('student_schedules')->insert($student_sh);
                }
            }
            else
                {
                    echo "casca en $course->name pq esta vacio o algo";
                }

        }

    }}

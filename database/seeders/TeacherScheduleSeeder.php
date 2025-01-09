<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;


class TeacherScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('email', 'like', '%@javierFactory.com')->where('user_type', 'teacher')->pluck('id');
        //$teachers = User::where('user_type', 'teacher')->pluck('id');
        $courses = Course::with('subjects')->get();
        $subjects = collect();
        $days = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];
        //$hours = ['hour_1', 'hour_2', 'hour_3', 'hour_4', 'hour_5', 'hour_6'];



        foreach ($teachers as $teacherId) {

            echo $teacherId;


            $assignedCourses = $courses->shuffle()->take(3);
            foreach ($days as $day) {
                echo $day;


                // This sould be taken all the subjects of those 3 courses, and shuffle
                $assignedSubjects = $courses->subjects->shuffle()->take(6);


                //testing
                echo $teacherId;
                echo $assignedSubjects->code[0];

                echo  $assignedSubjects->name;
                $schedule = [
                    'user_id' => $teacherId,

                    'course_id' => null,
                    'day_week' => $day,

                    'hour' => null,
                    'hour_1' => $assignedSubjects[0],
                    'hour_2' => $assignedSubjects[1],
                    'hour_3' => $assignedSubjects[2],
                    'hour_4' => $assignedSubjects[3],
                    'hour_5' => $assignedSubjects[4],
                    'hour_6' => $assignedSubjects[5],


                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                DB::table('schedules')->insert($schedule);
            }
        }
    }
}

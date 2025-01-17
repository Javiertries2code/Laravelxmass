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
        //$teachers = User::where('email', 'like', '%@javierFactory.com')->where('user_type', 'teacher')->pluck('id');
        $teachers = User::where('user_type', 'teacher')->pluck('id');
        $courses = Course::with('subjects')->get();
        $subjects = collect();
        $assignedSubjects = collect();
        $assignedCourses = collect();
        $days = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];
        //$hours = ['hour_1', 'hour_2', 'hour_3', 'hour_4', 'hour_5', 'hour_6'];



        foreach ($teachers as $teacherId) {

            // echo $teacherId;


            $assignedCourses = $courses->shuffle()->take(3);

            foreach ($days as $day) {
               // echo $day;


                // This sould be taken all the subjects of those 3 courses, and shuffle
                $subjects =  $assignedCourses[0]->subjects;

                $assignedSubjects = $subjects->shuffle()->take(6);


                //testing
                //cho $assignedSubjects[0]->id."subject";


                $schedule = [
                    'user_id' => $teacherId,
                    //'user_id' => null,


                    //'course_id' => null,
                    'day_week' => $day,

                   // 'hour' => null,
                    'hour_1' => $assignedSubjects[0]->id,
                    'hour_3' => $assignedSubjects[2]->id,
                    'hour_4' => $assignedSubjects[3]->id,
                    'hour_2' => $assignedSubjects[1]->id,
                    'hour_5' => $assignedSubjects[4]->id,
                    'hour_6' => $assignedSubjects[5]->id,


                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                DB::table('schedules')->insert($schedule);
            }
        }
    }
}

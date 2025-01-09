<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Subject;

class CourseSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
//As for now, I know the code fo the subjects, i can manualy choose what subject goes in every course
//there is random course subject  seeder already written in case of


        $subject_course_1 = Subject::whereIn('code', ['Asignatura 1', 'Asignatura 2', 'Asignatura 3','Asignatura 4', 'Asignatura 5','Asignatura 6'])->pluck('id');
        $courses[0]->subjects()->attach( $subject_course_1 );

        $subject_course_2 = Subject::whereIn('code', ['Asignatura 1', 'Asignatura 3', 'Asignatura 5', 'Asignatura 11', 'Asignatura 15', 'Asignatura 19', 'Asignatura 20'])->pluck('id');
        $courses[1]->subjects()->attach( $subject_course_2 );

        $subject_course_3 = Subject::whereIn('code', ['Asignatura 3', 'Asignatura 6', 'Asignatura 9', 'Asignatura 12', 'Asignatura 16', 'Asignatura 18'])->pluck('id');
        $courses[2]->subjects()->attach( $subject_course_3 );

        $subject_course_4 = Subject::whereIn('code', ['Asignatura6', 'Asignatura 14', 'Asignatura 5', 'Asignatura 17', 'Asignatura 1', 'Asignatura 19', 'Asignatura 20'])->pluck('id');
        $courses[3]->subjects()->attach( $subject_course_4 );

        $subject_course_5 = Subject::whereIn('code', ['Asignatura 1', 'Asignatura 4', 'Asignatura 9', 'Asignatura 13', 'Asignatura 14', 'Asignatura 17', 'Asignatura 20'])->pluck('id');
        $courses[4]->subjects()->attach( $subject_course_5 );



    }
}

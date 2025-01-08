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

        $subject_course_1 = Subject::whereIn('code', ['Asignatura 1', 'Asignatura 2', 'Asignatura 3','Asignatura 6'])->pluck('id');
        $courses[0]->subjects()->attach( $subject_course_1 );

        $subject_course_2 = Subject::whereIn('code', ['Asignatura 1', 'Asignatura 4', 'Asignatura 5', 'Asignatura 8'])->pluck('id');
        $courses[0]->subjects()->attach( $subject_course_2 );

        $subject_course_3 = Subject::whereIn('code', ['Asignatura 1', 'Asignatura 4', 'Asignatura 3', 'Asignatura 7', 'Asignatura 6'])->pluck('id');
        $courses[0]->subjects()->attach( $subject_course_3 );



    }
}

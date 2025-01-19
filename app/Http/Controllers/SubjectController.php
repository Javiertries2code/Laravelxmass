<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function subjectsList()
    {
        return $this->redirectSubjects();
    }

    public function subjectDelete(Request $request)
    {
        Subject::where('id', $request->id)->delete();
        return redirect()->route('subjects.subjectsList')->with('success', 'La asignatura ha sido eliminada exitosamente.');    }

    public function createSubject()
    {
        $headers = ['Horas', 'Codigo'];

        return view('subjects.createSubject', compact('headers'));
    }


    public function storeSubject(Request $request)
    {
        Subject::create($request->all());
        return redirect()->route('subjects.subjectsList')->with('success', 'La asignatura ha sido guardada exitosamente.');

    }
    public function editSubject(String $id)
    {
        $subject = Subject::findOrFail($id);
        $teachers_total = \App\Models\User::where('user_type', 'teacher')->get();
        $teachers = [];
        foreach ($teachers_total as $teacher) {
            if ( $teacher->subjects()->count() < 3 ) {
                $teachers[] = $teacher;
            }
        }

        return view('subjects.editSubject', compact('subject', 'teachers'));
    }

    public function updateSubject(Request $request)
    {
        $subject = Subject::findOrFail($request->id);
        $subject->update($request->all());
        return redirect()->route('subjects.subjectsList')->with('success', 'La asignatura ha sido guardada exitosamente.');    }


    private function redirectSubjects()
    {



        $headers = [
            'id' => 'id',
            'hours' => 'Horas',
            'code' => 'Codigo',
            'teacher_name' => 'Profesor',
        ];

        $actions = [
            'delete' => 'subject.subjectDelete',
            'edit' => 'subject.editSubject',
            'create' => 'subject.createSubject',
        ];

        $currentPage = request()->query('page', 1);
        $data = Subject::paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

        foreach ($data as $d) {

            $d->teacher_name = '';
            if ($d->teacher_id) {
                $teacher = \App\Models\User::where('id', $d->teacher_id)->first();
                if ($teacher) {
                    $d->teacher_name = $teacher->name;
                    $d->teacher_email = $teacher->email;
                }
            }
        }

        $title = 'Listado de Asignaturas';
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));

    }
}

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
        return view('subjects.editSubject', compact('subject'));
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
        ];

        $actions = [
            'delete' => 'subject.subjectDelete',
            'edit' => 'subject.editSubject',
            'create' => 'subject.createSubject',
        ];

        $currentPage = request()->query('page', 1);
        $data = Subject::paginate(config('app.pagination_count'), ['*'], 'page', $currentPage);

        $title = 'Listado de Asignaturas';
        return view('admin.listTableData', compact('title', 'data', 'headers', 'actions'));

    }
}

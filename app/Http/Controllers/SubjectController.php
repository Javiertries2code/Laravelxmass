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
    return $this->redirectSubjects();
}

public function createSubject()
{
    $headers = ['Horas' , 'Codigo'];

    return view('subjects.createSubject', compact( 'headers'));
}


public function storeSubject(Request $request)
{
    Subject::create($request->all());
    return $this->redirectSubjects();
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
    return $this->redirectSubjects();
}


private function redirectSubjects()
{
    $headers = ['id', 'hours', 'code'];
    $subjects = Subject::all();
    return view('subjects.subjectsList', compact('subjects', 'headers'));
}

}

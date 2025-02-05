<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::orderBy('created_at')->get();
        return response()->json(['subjects'=>$subjects])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->name = $request->input('name');
        $subject->save();
        return response()->json(['message' => 'Asignatura creada con exito', 'subject' => $subject])
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
return response()->json($subject)->setStatusCode(Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->name = $request->input('name');
        $subject->save();
        return response()->json(['message' => 'Asignatura actualizada con exito', 'subject' => $subject])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(['message' => 'Asignatura eliminada con exito'])
            ->setStatusCode(Response::HTTP_OK);
    }
}

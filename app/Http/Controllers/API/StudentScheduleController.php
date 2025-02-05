<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class StudentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentSchedules = StudentSchedule::orderBy('created_at')->get();
        return response()->json(['studentSchedules' => $studentSchedules])
            ->setStatusCode(Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentSchedule $studentSchedule)
    {
        return response()->json(['studentSchedule' => $studentSchedule])
            ->setStatusCode(Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentSchedule $studentSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentSchedule $studentSchedule)
    {
        //
    }
}

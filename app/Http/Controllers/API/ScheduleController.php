<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::orderBy('created_at')->get();
        return response()->json(['schedules' => $schedules])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $schedule = Schedule::create($request->all());
        return response()->json(['schedule' => $schedule], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
    return response()->json($schedule)->setStatusCode(Response::HTTP_OK);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update($request->all());
        return response()->json(['schedule' => $schedule])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(['message' => 'Schedule deleted'], Response::HTTP_NO_CONTENT);
    }
}

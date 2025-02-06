<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $meetings = Meeting::orderBy('created_at')->get();
        return response()->json(['meetings'=>$meetings])
            ->setStatusCode(Response::HTTP_OK);
        }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $meeting = Meeting::create($request->all());
        return response()->json(['meeting' => $meeting])
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());
        return response()->json(['meeting' => $meeting])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return response()->json(['message' => 'Meeting deleted'])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return response()->json($meeting)->setStatusCode(Response::HTTP_OK);

    }

}

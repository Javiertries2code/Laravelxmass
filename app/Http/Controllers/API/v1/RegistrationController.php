<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::orderBy('created_at')->get();
        return response()->json(['registrations'=>$registrations])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $registration = Registration::create($request->all());
        return response()->json(['registration' => $registration])
            ->setStatusCode(Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        return response()->json($registration)->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        $registration->update($request->all());
        return response()->json(['registration' => $registration])
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();
        return response()->json(['message' => 'Registro eliminado'])
            ->setStatusCode(Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user && ($user->hasRole('admin') || $user->hasRole('god')) ) {
            return redirect()->route('admin.adminhome');
        }

        if ($user && $user->hasRole('teacher')) {
            return redirect()->route('teacher.index');
        }

        if ($user && $user->hasRole('student')) {
            return redirect()->route('student.index');
        }

        return view('home');
    }


}

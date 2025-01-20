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

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user && $user->user_type === 'admin' || $user->user_type === 'god') {
            return redirect()->route('admin.adminhome');
        }

        if ($user && $user->user_type === 'teacher') {
            return redirect()->route('teacher.index');
        }

        if ($user && $user->user_type === 'student') {
            return redirect()->route('roothome');
        }


        return view('home');
    }

    public function goHome()
    {

        if (auth()->check()) {
            if (auth()->user()->user_type == 'admin' ) {
                return redirect()->route('admin.adminhome');
            }
            if (auth()->user()->user_type == 'teacher') {
                return redirect()->route('teacher.teacherhome');
            }
            if (auth()->user()->user_type == 'student' ) {
                return redirect()->route('studentHome');
            }
        }
        else
        {
           echo "else";
        }

        return redirect()->route('login');
    }
}


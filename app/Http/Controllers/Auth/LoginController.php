<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

///just in case it works
protected function authenticated($request, $user)
    {
        $role = $user->getRoleNames()->first();

        switch ($role) {
            case 'god':
                return redirect('/admin/adminhome');
            case 'admin':
                return redirect('/admin/adminhome');
            case 'teacher':
                return redirect('/teacher/teacherhome');
            case 'student':
                return redirect('/student/studenthome');
            default:
                return redirect('/home');
        }
    }
///

    protected function redirectTo()
    {
      //  dd(auth()->user()->getRoleNames()->first());

        if (auth()->check()) {
            $user = auth()->user();

            $role = $user->getRoleNames()->first();
         dd($role);
            switch ($role) {
                case 'god':
                    return '/admin/adminhome';
                case 'admin':
                    return '/admin/adminhome';
                case 'teacher':
                    return '/teacher/teacherhome';
                case 'student':
                    return '/student/studenthome';
                default:
                    return '/home';
            }
       }

        return '/student/home';
    }

}

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
    protected $redirectTo = '/home';

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

    //El fallo no afecta
    protected function redirectTo() {
        switch (auth()->user()->user_type) {
            case 'God':
                return '/god/home';
                break;
            case 'admin':
                return '/admin/home';
                break;
            case 'teacher':
                return '/teacher/home';
                break;
            case 'student':
                return '/student/home';
                break;
            default:
                return '/home';
        }
  }
}

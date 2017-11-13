<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', [
            'except'    => [
                'destroy',
            ],
        ]);
    }

    public function create()
    {
        return view('auth.login.create');
    }

    public function store(Request $request)
    {
        return $this->login($request);
    }

    public function destroy(Request $request)
    {
        return $this->logout($request);
    }

    protected function redirectPath()
    {
        return route('home');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect($this->redirectPath());
    }
}

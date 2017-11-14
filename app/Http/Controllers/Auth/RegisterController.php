<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        return view('auth.register.create');
    }

    public function store(Request $request)
    {
        return $this->register($request);
    }

    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createUser($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    protected function redirectPath()
    {
        return route('home');
    }

    protected function registered(Request $request, $user)
    {
        session()->flash('flash_message', 'Registration successful. You are now logged in!');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
        ]);
    }

    protected function createUser(array $data)
    {
        return User::create([
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
        ]);
    }
}

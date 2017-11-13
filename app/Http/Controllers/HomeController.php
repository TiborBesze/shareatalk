<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return auth()->check() ? $this->authenticated() : $this->guest();
    }

    protected function guest()
    {
        return view('guest.index');
    }

    protected function authenticated()
    {
        return view('user.index');
    }
}

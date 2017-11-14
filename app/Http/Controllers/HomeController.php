<?php

namespace App\Http\Controllers;

use App\Talk;
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
        $talks = Talk::all()->reverse();

        return view('user.index')->with([
            'talks'     => $talks,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Talk;
use Illuminate\Http\Request;

class TalkController extends Controller
{
    public function show(Talk $talk)
    {
        return view('talk.show')->with([
            'talk'  => $talk,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Talk;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Talk $talk)
    {
        $result = auth()->user()->like($talk);

        return $result ? ['status' => 'success'] : ['status' => 'error'];
    }

    public function destroy(Talk $talk)
    {
        $result = auth()->user()->unlike($talk);

        return $result ? ['status' => 'success'] : ['status' => 'error'];
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user, Request $request)
    {
        $result = auth()->user()->follow($user);

        return $result ? ['status' => 'success'] : ['status' => 'error'];
    }

    public function destroy(User $user, Request $request)
    {
        $result = auth()->user()->unfollow($user);

        return $result ? ['status' => 'success'] : ['status' => 'error'];
    }
}

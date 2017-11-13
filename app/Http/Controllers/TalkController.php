<?php

namespace App\Http\Controllers;

use App\Talk;
use Illuminate\Http\Request;
use App\Services\MetaParser\DriverResolverInterface as DriverResolver;

class TalkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'show',
            ],
        ]);
    }

    public function create()
    {
        return view('talk.create');
    }

    public function store(Request $request, DriverResolver $resolver)
    {
        $request->validate([
            'url'   => 'required|url',
        ]);

        $url = $request->url;
        $driver = $resolver->getDriverByURL($url);

        if (!$driver) {
            return redirect()->back();
        }

        $talk = Talk::make($driver->parse($url));
        $talk->user_id = auth()->user()->id;
        $talk->save();

        return redirect()->route('talk.show', ['talk' => $talk->id]);
    }

    public function show(Talk $talk)
    {
        return view('talk.show')->with([
            'talk'  => $talk,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Talk;
use Illuminate\Http\Request;
use App\Services\MetaParser\DriverResolverInterface as DriverResolver;
use Illuminate\Support\Facades\Validator;

class TalkController extends Controller
{
    protected $resolver;

    public function __construct(DriverResolver $resolver)
    {
        $this->resolver = $resolver;

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

    public function store(Request $request)
    {
        $this->validator($request->all())->validate($request);
        $request->validate([
            'url'   => 'required|url',
        ]);

        $url = $request->url;
        $driver = $this->resolver->getDriverByURL($url);

        $talk = Talk::make($driver->parse($url));
        $talk->user_id = auth()->user()->id;
        $talk->save();

        return redirect()->route('talk.show', ['talk' => $talk->id]);
    }

    public function show(Talk $talk)
    {
        $talk->load('user', 'likers');

        $user = auth()->user();

        if ($user) {
            $followable = $user->id !== $talk->user->id;
            $likeable = 1;
            $following = $user->followed($talk->user);
            $liked = $user->liked($talk);
        }

        return view('talk.show')->with([
            'talk'          => $talk,
            'followable'    => $followable ?? 0,
            'likeable'      => $likeable ?? 0,
            'following'     => $following ?? 0,
            'liked'         => $liked ?? 0,
        ]);
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'url'   => 'required|url',
        ]);

        $validator->after(function ($validator) use ($data) {
            if ($this->resolver->getDriverByURL($data['url']) === null) {
                $validator->errors()->add('url', 'This url is currently not supported.');
            }
        });

        return $validator;
    }
}

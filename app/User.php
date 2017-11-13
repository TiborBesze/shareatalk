<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function talks()
    {
        return $this->hasMany(Talk::class);
    }

    public function liked_talks()
    {
        return $this->belongsToMany(Talk::class, 'likes', 'user_id', 'talk_id');
    }

    public function like(Talk $talk)
    {
        $result = $this->liked_talks()->syncWithoutDetaching([
            'talk_id'   => $talk->id,
        ]);

        return in_array($talk->id, $result['attached'], true);
    }

    public function unlike(Talk $talk)
    {
        $result = $this->liked_talks()->detach($talk->id);

        return !!$result;
    }
}

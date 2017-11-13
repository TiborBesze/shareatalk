<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    protected $fillable = [
        'url', 'embed_url', 'title', 'description', 'thumbnail', 'width',
        'height', 'platform', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likers()
    {
        return $this->belongsToMany(User::class, 'likes', 'talk_id', 'user_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    protected $fillable = [
        'url', 'embed_url', 'title', 'description', 'thumbnail', 'width',
        'height', 'platform',
    ];
}

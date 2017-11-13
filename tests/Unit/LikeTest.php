<?php

namespace Tests\Unit;

use App\User;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->user_a = User::create([
            'firstname'     => 'John',
            'lastname'      => 'Doe',
            'email'         => 'john.doe@example.com',
            'password'      => bcrypt('password'),
        ]);

        $url = 'https://www.example.com/test-video';

        $this->user_a->talks()->create([
            'url'           => $url,
            'embed_url'     => $url,
            'title'         => '',
            'description'   => '',
            'thumbnail'     => '',
            'width'         => 0,
            'height'        => 0,
            'platform'      => 'fake',
        ]);

        $this->user_b = User::create([
            'firstname'     => 'Jane',
            'lastname'      => 'Doe',
            'email'         => 'jane.doe@example.com',
            'password'      => bcrypt('password'),
        ]);
    }

    /** @test */
    public function users_can_like_each_others_talks()
    {
        $talk = $this->user_a->talks->first();
        $this->user_b->like($talk);

        $like = Like::where('user_id', $this->user_b->id)
            ->where('talk_id', $talk->id)
            ->first();

        $this->assertInstanceOf(Like::class, $like);
        $this->assertEquals($this->user_b->id, $like->user_id);
        $this->assertEquals($talk->id, $like->talk_id);
    }
}

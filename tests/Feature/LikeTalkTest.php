<?php

namespace Tests\Feature;

use App\User;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTalkTest extends TestCase
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
    public function authenticated_users_can_like_each_others_talks()
    {
        $this->disableExceptionHandling();
        $this->be($this->user_b);
        $this->assertAuthenticatedAs($this->user_b);

        $talk = $this->user_a->talks->first();

        $response = $this->json('POST', route('like.store', ['talk' => $talk->id]), [
            '_token'    => csrf_token(),
        ]);

        $response->assertJson([
            'status'    => 'success',
        ]);
    }

    /** @test */
    public function authenticated_users_can_unlike_their_liked_talks()
    {
        $this->disableExceptionHandling();
        $this->be($this->user_b);
        $this->assertAuthenticatedAs($this->user_b);

        $talk = $this->user_a->talks->first();

        $this->user_b->like($talk);

        $like = Like::where('user_id', $this->user_b->id)
            ->where('talk_id', $talk->id)
            ->first();

        $this->assertInstanceOf(Like::class, $like);

        $response = $this->json('DELETE', route('like.destroy', ['talk' => $talk->id]), [
            '_token'    => csrf_token(),
        ]);

        $response->assertJson([
            'status'    => 'success',
        ]);
    }

    /** @test */
    public function guests_cannot_like_talks()
    {
        $this->assertGuest();
        $this->assertNull(Like::first());

        $talk = $this->user_a->talks->first();

        $response = $this->json('POST', route('like.store', ['talk' => $talk->id]), [
            '_token'    => csrf_token(),
        ]);

        $response->assertStatus(401);
        $this->assertNull(Like::first());
    }
}

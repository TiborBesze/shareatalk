<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowUserTest extends TestCase
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

        $this->user_b = User::create([
            'firstname'     => 'Jane',
            'lastname'      => 'Doe',
            'email'         => 'jane.doe@example.com',
            'password'      => bcrypt('password'),
        ]);
    }

    /** @test */
    public function authenticated_users_can_follow_each_other()
    {
        $this->disableExceptionHandling();
        $this->be($this->user_a);
        $this->assertAuthenticatedAs($this->user_a);

        $response = $this->json('POST', route('follow.store', ['user' => $this->user_b->id]), []);
        $response->assertStatus(200);
        $response->assertJson([
            'status'    => 'success',
        ]);

        $following = $this->user_a->following->first();
        $this->assertInstanceOf(User::class, $following);
        $this->assertEquals($this->user_b->id, $following->id);

        $follower = $this->user_b->followers->first();
        $this->assertInstanceOf(User::class, $follower);
        $this->assertEquals($this->user_a->id, $follower->id);
    }

    /** @test */
    public function authenticated_users_can_unfollow_their_followed_users()
    {
        $this->disableExceptionHandling();
        $this->be($this->user_b);
        $this->assertAuthenticatedAs($this->user_b);

        $this->user_b->follow($this->user_a);

        $following = $this->user_b->following->first();
        $this->assertInstanceOf(User::class, $following);
        $this->assertEquals($this->user_a->id, $following->id);
        $this->assertEquals(1, $this->user_a->followers()->count());

        $response = $this->json('DELETE', route('follow.destroy', ['user' => $this->user_a->id]), []);
        $response->assertStatus(200);
        $response->assertJson([
            'status'    => 'success',
        ]);

        $this->assertEquals(0, $this->user_a->followers()->count());
    }

    /** @test */
    public function guests_cannot_follow_users()
    {
        $this->assertGuest();

        $response = $this->json('POST', route('follow.store', ['user' => $this->user_b->id]), []);
        $response->assertStatus(401);

        $this->assertEquals(0, $this->user_b->followers->count());
    }
}

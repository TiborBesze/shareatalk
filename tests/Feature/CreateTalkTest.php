<?php

namespace Tests\Feature;

use App\Talk;
use App\User;
use Tests\TestCase;
use App\Services\MetaParser\FakeDriverResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\MetaParser\DriverResolverInterface;

class CreateTalkTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->user = User::create([
            'firstname'     => 'Bob',
            'lastname'      => 'Example',
            'email'         => 'bob@example.com',
            'password'      => bcrypt('password'),
        ]);
    }

    /** @test */
    public function users_can_visit_the_post_talk_page()
    {
        $this->disableExceptionHandling();
        $this->be($this->user);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get(route('talk.create'));
        $response->assertStatus(200);
        $response->assertSeeText('Post a talk on your timeline');
        $response->assertSeeText('URL');
    }

    /** @test */
    public function guests_cannot_visit_the_post_talk_page()
    {
        $this->assertGuest();

        $response = $this->get(route('talk.create'));
        $response->assertRedirect(route('auth.login.create'));
    }

    /** @test */
    public function users_can_post_a_talk()
    {
        $this->disableExceptionHandling();
        $this->be($this->user);
        $this->assertAuthenticatedAs($this->user);

        $this->assertNull(Talk::first());

        $url = 'https://www.example.com/example-video';

        $parser = new FakeDriverResolver;
        $this->app->instance(DriverResolverInterface::class, $parser);

        $response = $this->post(route('talk.store'), [
            '_token'    => csrf_token(),
            'url'       => $url,
        ]);

        $talk = Talk::first();

        $this->assertInstanceOf(Talk::class, $talk);
        $this->assertEquals($url, optional($talk)->url);
        $response->assertRedirect(route('talk.show', ['talk' => optional($talk)->id]));
    }
}

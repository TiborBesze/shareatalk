<?php

namespace Tests\Feature;

use App\Talk;
use App\User;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;
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

        $resolver = new FakeDriverResolver;
        $this->app->instance(DriverResolverInterface::class, $resolver);

        $response = $this->post(route('talk.store'), [
            '_token'    => csrf_token(),
            'url'       => $url,
        ]);

        $talk = Talk::first();

        $this->assertInstanceOf(Talk::class, $talk);
        $this->assertEquals($url, optional($talk)->url);
        $response->assertRedirect(route('talk.show', ['talk' => optional($talk)->id]));
    }

    /** @test */
    public function guests_cannot_post_a_talk()
    {
        $this->assertGuest();
        $this->assertNull(Talk::first());

        $url = 'https://www.example.com/test-video';

        $resolver = new FakeDriverResolver;
        $this->app->instance(DriverResolverInterface::class, $resolver);

        $response = $this->post(route('talk.store', [
            '_token'    => csrf_token(),
            'url'       => $url,
        ]));

        $this->assertNull(Talk::first());
        $response->assertRedirect(route('auth.login.create'));
    }

    /** @test */
    public function posting_a_talk_associates_it_with_the_logged_in_user()
    {
        $this->be($this->user);
        $this->assertAuthenticatedAs($this->user);

        $url = 'https://www.example.com/test-video';

        $talk = $this->user->talks()->create([
            'url'           => $url,
            'embed_url'     => $url,
            'title'         => '',
            'description'   => '',
            'thumbnail'     => '',
            'width'         => 0,
            'height'        => 0,
            'platform'      => 'fake',
        ]);

        $this->assertInstanceOf(User::class, $talk->user);
        $this->assertEquals($this->user->id, $talk->user->id);
    }
}

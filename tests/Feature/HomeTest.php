<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $talk;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->user = User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->title = 'Cruddy by Design';

        $this->talk = $this->user->talks()->create([
            'url'           => 'https://www.youtube.com/watch?v=MF0jFKvS4SI',
            'embed_url'     => 'https://www.youtube.com/embed/MF0jFKvS4SI',
            'title'         => $this->title,
            'description'   => 'Adam Wathan\'s Laracon US 2017 talk',
            'thumbnail'     => 'https://i.ytimg.com/vi/MF0jFKvS4SI/maxresdefault.jpg',
            'width'         => 1280,
            'height'        => 720,
            'platform'      => 'youtube',
        ]);

    }

    /** @test */
    public function guests_can_view_the_home_page()
    {
        $this->assertGuest();

        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    /** @test */
    public function guests_are_prompted_to_authenticate_when_visiting_the_home_page()
    {
        $response = $this->get(route('home'));

        $response->assertSeeText('Register an account');
        $response->assertSeeText('Log into an existing account');
    }

    /** @test */
    public function authenticated_users_can_see_their_news_feed_when_visiting_the_home_page()
    {
        $this->assertInstanceOf(User::class, $this->user);
        $this->be($this->user);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSeeText('News Feed');
        $response->assertSeeText($this->title);
    }

    /** @test */
    public function news_feed_shows_the_user_posted_the_talk()
    {
        $this->be($this->user);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSeeText($this->title);
        $response->assertSeeText('Posted by: ' . $this->talk->user->fullname);
    }

    /** @test */
    public function news_feed_shows_the_created_at_date() {
        $this->be($this->user);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSeeText('Posted at: ' . $this->talk->created_at->format('d/m/Y'));
    }
}

<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTalkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function visitors_can_view_a_talk()
    {
        $this->disableExceptionHandling();

        $title = 'Cruddy by Design';
        $description = 'Adam Wathan\'s Laracon US 2017 talk';

        $user = User::create([
            'firstname'     => 'John',
            'lastname'      => 'Doe',
            'email'         => 'john.doe@example.com',
            'password'      => bcrypt('password')
        ]);

        $talk = $user->talks()->create([
            'url'           => 'https://www.youtube.com/watch?v=MF0jFKvS4SI',
            'embed_url'     => 'https://www.youtube.com/embed/MF0jFKvS4SI',
            'title'         => $title,
            'description'   => $description,
            'thumbnail'     => 'https://i.ytimg.com/vi/MF0jFKvS4SI/maxresdefault.jpg',
            'width'         => 1280,
            'height'        => 720,
            'platform'      => 'youtube',
            'user_id'       => 1,
        ]);

        $response = $this->get(route('talk.show', ['talk' => $talk->id]));

        $response->assertSeeText(e($title));
        $response->assertSeeText(e($description));
    }
}

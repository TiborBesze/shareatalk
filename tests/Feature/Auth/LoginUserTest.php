<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    /** @test */
    public function guests_can_visit_a_login_page()
    {
        $this->assertGuest();

        $response = $this->get(route('auth.login.create'));

        $response->assertSeeText(e('Log into an existing account'));
        $response->assertSeeText(e('E-Mail Address'));
        $response->assertSeeText(e('Password'));
    }

    /** @test */
    public function guests_can_log_into_an_existing_account()
    {
        $this->assertGuest();

        $user = User::create([
            'firstname'     => 'John',
            'lastname'      => 'Doe',
            'email'         => 'john.doe@example.com',
            'password'      => bcrypt('password'),
        ]);

        $this->assertInstanceOf(User::class, $user);

        $response = $this->post(route('auth.login.store'), [
            '_token'        => csrf_token(),
            'email'         => 'john.doe@example.com',
            'password'      => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function authenticated_users_cannot_access_the_login_page()
    {
        $user = User::create([
            'firstname'     => 'John',
            'lastname'      => 'Doe',
            'email'         => 'john.doe@example.com',
            'password'      => bcrypt('password'),
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->be($user);
        $this->assertAuthenticatedAs($user);

        $response = $this->get(route('auth.login.create'));
        $response->assertRedirect(route('home'));
    }

    /** @test */
    public function authenticated_users_cannot_perform_a_login()
    {
        $user_a = User::create([
            'firstname'     => 'John',
            'lastname'      => 'Doe',
            'email'         => 'john.doe@example.com',
            'password'      => bcrypt('password'),
        ]);

        $this->assertInstanceOf(User::class, $user_a);
        $this->be($user_a);
        $this->assertAuthenticatedAs($user_a);

        $user_b = User::create([
            'firstname'     => 'Jane',
            'lastname'      => 'Doe',
            'email'         => 'jane.doe@example.com',
            'password'      => bcrypt('password'),
        ]);

        $this->assertInstanceOf(User::class, $user_b);

        $response = $this->post(route('auth.login.store'), [
            '_token'    => csrf_token(),
            'email'     => 'jane.doe@example.com',
            'password'  => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user_a);
    }
}

<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }

    /** @test */
    public function guests_can_visit_a_registration_page()
    {
        $this->assertGuest();

        $response = $this->get(route('auth.register.create'));

        $response->assertSeeText(e('Register an account'));
        $response->assertSeeText(e('First Name'));
        $response->assertSeeText(e('Last Name'));
        $response->assertSeeText(e('E-Mail Address'));
        $response->assertSeeText(e('Password'));
        $response->assertSeeText(e('Confirm Password'));
    }

    /** @test */
    public function guests_can_register_an_account()
    {
        $this->assertGuest();
        $this->assertNull(User::first());

        $response = $this->post(route('auth.register.store'), [
            '_token'                => csrf_token(),
            'firstname'             => 'John',
            'lastname'              => 'Doe',
            'email'                 => 'john.doe@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('home'));

        $user = User::first();
        $this->assertInstanceOf(User::class, $user);
        $this->assertAuthenticatedAs($user);
    }
}

<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function register_returns_form_view()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function register_returns_validation_error()
    {
        $response = $this->post('register', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);

        $response = $this->post('register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect(route('home'));

        $user = User::where('email', $email)->where('name', $name)->first();
        $this->assertNotNull($user);

        $this->assertAuthenticatedAs($user);
    }
}

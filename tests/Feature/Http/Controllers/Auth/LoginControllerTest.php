<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /** @test */
    public function login_returns_view()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }
}

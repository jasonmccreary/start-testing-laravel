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
}

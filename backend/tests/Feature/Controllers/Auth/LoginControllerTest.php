<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginWorks() {
        $user = User::firstOrFail();

        $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password'
        ]))->assertJsonFragment([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
        ]);
    }
}

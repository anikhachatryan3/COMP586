<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostControllerTest extends TestCase
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
    public function testCreateWorks() {
        $user = User::firstOrFail();

        $this->post(route('create-post', [
            'title' => 'testing',
            'body' => 'test 123',
            'user_id' => $user->id
        ]))->assertJsonFragment([
            'title' => 'testing',
            'body' => 'test 123',
            'user_id' => $user->id
        ]);
    }
}

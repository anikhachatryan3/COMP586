<?php

namespace Tests\Feature\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\CommentFactory;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentControllerTest extends TestCase
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
    public function testDeleteWorks() {
        $user = User::firstOrFail();
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->delete(route('delete-comment', [
            'comment' => $comment->id,
            'user_id' => $user->id
        ]))->assertJsonFragment([
            "message" => "Successfully deleted comment!"
        ]);
    }
}

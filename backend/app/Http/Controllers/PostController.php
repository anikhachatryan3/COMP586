<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    public function allPosts() {
        return Post::all();
    }

    public function myPosts(User $user) {
        return $user->posts;
    }

    public function post(Post $post) {
        return $post;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Exceptions\JWTException;
// use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    public function allPosts() {
        $posts = Post::latest()->get();
        for($i = 0; $i < $posts->count(); $i++) {
            $posts[$i]->user;
        }
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function myPosts(User $user) {
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        for($i = 0; $i < $posts->count(); $i++) {
            $posts[$i]->user;
            $posts[$i]->comments;
            for($j = 0; $j < $posts[$i]->comments->count(); $j++) {
                $posts[$i]->comments[$j]->user;
            }
        }
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function post(Post $post) {
        $post->comments;
        $post->user;
        $post->username;
        for($i = 0; $i < $post->comments->count(); $i++) {
            $post->comments[$i]->user;
        }
        return response()->json([
            'post' => $post
        ], 200);
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        if($post->save()) {
            $post->user;
            $post->comments;
            for($i = 0; $i < $post->comments->count(); $i++) {
                $post->comments[$i]->user;
            }
            $post->refresh();
            return response()->json([
                'post' => $post
            ], 200);
        }
        return response()->json([
            'error' => 'Unable to create post!'
        ], 406);
    }

    public function deletePost(Post $post, Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        $user = User::where('id', $request->user_id)->first();
        if($user->role == 'ADMIN' || $user->id == $post->user_id) {
            if($post->delete()) {
                return response()->json([
                    'message' => 'Successfully deleted post!'
                ], 200);
            }
            return response()->json([
                'error' => 'Could not delete post!'
            ]);
        }
        return response()->json([
            'error' => 'You do not have permission to delete this post.'
        ]);
    }
}

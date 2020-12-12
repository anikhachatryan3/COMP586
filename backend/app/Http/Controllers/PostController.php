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
        return response()->json([
            'posts' => Post::latest()->get()
        ], 200);
    }

    public function myPosts(User $user) {
        return response()->json([
            'posts' => $user->posts()->orderBy('created_at', 'desc')->get()
        ], 200);
    }

    public function post(Post $post) {
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
        if($user->role->code == 'ADMIN' || $user->id == $post->user_id) {
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

    public function editPost(Post $post, Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'body' => 'required'
        ]);
        $user = User::where('id', $request->user_id)->first();
        if($user->id == $post->user_id) {
            $post->title = $request->title;
            $post->body = $request->body;
            if($post->save()) {
                return response()->json([
                    'message' => 'Successfully updated post!'
                ]);
            }
            return response()->json([
                'error' => 'Could not edit post.'
            ]);
        }
        return response()->json([
            'error' => 'You do not have permission to edit this post.'
        ]);
    }
}

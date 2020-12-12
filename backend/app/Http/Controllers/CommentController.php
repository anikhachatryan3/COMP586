<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller {
    public function create(Post $post, Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'text' => 'required'
        ]);
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->text = $request->text;
        $comment->post_id = $post->id;
        if($comment->save()) {
            $comment->user;
            $comment->refresh();
            return response()->json([
                'comment' => $comment
            ], 200);
        }
        return response()->json([
            'error' => 'Unable to create comment.'
        ], 406);
    }

    public function deleteComment(Comment $comment, Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        $user = User::where('id', $request->user_id)->first();
        if($user->role == 'ADMIN' || $user->id == $comment->user_id) {
            if($comment->delete()) {
                return response()->json([
                    'message' => 'Successfully deleted comment!'
                ], 200);
            }
            return response()->json([
                'error' => 'Could not delete comment!'
            ]);
        }
        return response()->json([
            'error' => 'You do not have permission to delete this comment.'
        ]);
    }

    public function editComment(Comment $comment, Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'text' => 'required'
        ]);
        $user = User::where('id', $request->user_id)->first();
        if($user->id == $comment->user_id) {
            $comment->text = $request->text;
            if($comment->save()) {
                return response()->json([
                    'message' => 'Successfully updated comment!'
                ]);
            }
            return response()->json([
                'error' => 'Could not edit post.'
            ]);
        }
        return response()->json([
            'error' => 'You do not have permission to edit this comment.'
        ]);
    }
}

?>
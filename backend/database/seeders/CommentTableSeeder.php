<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $userStudent = User::whereHas('roles', function($query) {
        //     return $query->where('code', 'STUDENT');
        // })->firstOrFail();
        
        // $userAdmin = User::whereHas('roles', function($query) {
        //     return $query->where('code', 'ADMIN');
        // })->firstOrFail();

        // $posts = Post::all();

        // foreach($posts as $post) {
        //     Comment::factory()->count(3)->create([
        //         'post_id' => $post->id,
        //         'user_id' => $userStudent->id
        //     ]);
        //     Comment::factory()->count(2)->create([
        //         'post_id' => $post->id,
        //         'user_id' => $userAdmin->id
        //     ]);
        // }
    }
}

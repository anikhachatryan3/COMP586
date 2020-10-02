<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userStudent = User::whereHas('roles', function($query) {
            return $query->where('code', 'STUDENT');
        })->firstOrFail();
        Post::factory()->count(5)->create([
            'user_id' => $userStudent->id
        ]);

        $userAdmin = User::whereHas('roles', function($query) {
            return $query->where('code', 'ADMIN');
        })->firstOrFail();
        Post::factory()->count(5)->create([
            'user_id' => $userAdmin->id
        ]);
    }
}

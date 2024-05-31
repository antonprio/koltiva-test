<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Post::all()->each(function ($post) {
            $users = User::inRandomOrder()->take(5)->pluck('id');
            foreach ($users as $userId) {
                Comment::factory()->create(['post_id' => $post->id, 'user_id' => $userId]);
            }
        });       
    }
}

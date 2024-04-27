<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Posts\Post;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::withoutEvents(function () {
            for ($i = 0; $i < 200; ++$i) {
                $post = Post::create([
                    'title' => Str::random(100),
                    'body' => Str::random(500),
                    'author_id' => User::all()->first()->id
                ]);

                $post->categories()->sync([1, 2, 3]);
            }
        });
    }
}

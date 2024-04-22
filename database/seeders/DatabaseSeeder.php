<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Posts\Post;
use App\Models\Users\User;
use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        for ($i = 0; $i < 1000; ++$i) {
////            User::factory()->count(10)->create();
//            Post::withoutEvents(function () {
//                Post::create([
//                    'title' => Str::random(100),
//                    'body' => Str::random(10000),
//                    'author_id' => 1
//                ]);
//            });
//        }
//        $users = User::all();
//
//        $users->each(function($user) {
//            (Post::find(1))->views()->create([
//                'user_id' => $user->id
//            ]);
//        });
    }
}

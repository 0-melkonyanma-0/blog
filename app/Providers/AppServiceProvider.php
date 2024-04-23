<?php

declare(strict_types=1);

namespace App\Providers;

use App\DTO\Posts\CommentRequestDto;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use App\Policies\Posts\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
        Gate::policy(Post::class, PostPolicy::class);
    }
}

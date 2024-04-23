<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Posts\Category;
use App\Models\Posts\Comment;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Policies\Posts\CategoryPolicy;
use App\Policies\Posts\CommentPolicy;
use App\Policies\Posts\PostPolicy;
use App\Policies\Users\UserPolicy;
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
        Gate::policy(Comment::class, CommentPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}

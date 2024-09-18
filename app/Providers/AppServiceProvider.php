<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\PostRepository;
use App\Infrastructure\Persistence\EloquentPostRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // PostRepositoryインターフェースをEloquentPostRepositoryにバインド
        $this->app->bind(PostRepository::class, EloquentPostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

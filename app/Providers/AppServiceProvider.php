<?php

namespace App\Providers;

use App\Repository\Task\Interface\TaskRepositoryInterface;
use App\Repository\Task\TaskRepository;
use App\Repository\User\Interface\UserRepositoryInterface;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

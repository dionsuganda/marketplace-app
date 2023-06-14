<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Task\TaskRepository;
use App\Repository\Task\EloquentTaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentTaskRepository::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

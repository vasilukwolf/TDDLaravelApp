<?php

namespace App\Providers;

use App\Observers\TaskObserver;
use App\Task;
use Illuminate\Support\ServiceProvider;
use App\Observers\ProjectObserver;
use App\Project;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
    }
}

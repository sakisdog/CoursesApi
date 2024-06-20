<?php

namespace App\Providers;

use App\Repositories\CourseRepository;
use App\Services\CourseService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CourseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(CourseService::class, function ($app) {
            return new CourseService($app->make(CourseRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

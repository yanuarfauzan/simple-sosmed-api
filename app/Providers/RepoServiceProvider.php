<?php

namespace App\Providers;

use App\Repository\AuthRepo;
use App\Repository\RepoAuthInterface;
use App\Service\AuthService;
use App\Service\ServAuthInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepoAuthInterface::class, AuthRepo::class);
        $this->app->bind(ServAuthInterface::class, AuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

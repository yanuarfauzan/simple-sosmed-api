<?php

namespace App\Providers;

use App\Repository\AuthRepo;
use App\Service\AuthService;
use App\Repository\ResetPwRepo;
use App\Service\ResetPwService;
use App\Service\ServAuthInterface;
use App\Repository\RepoAuthInterface;
use App\Service\ServResetPwInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\RepoResetPwInterface;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepoAuthInterface::class, AuthRepo::class);
        $this->app->bind(ServAuthInterface::class, AuthService::class);
        $this->app->bind(RepoResetPwInterface::class, ResetPwRepo::class);
        $this->app->bind(ServResetPwInterface::class, ResetPwService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repository\AuthRepo;
use App\Service\AuthService;
use App\Repository\ResetPwRepo;
use App\Service\ResetPwService;
use App\Repository\PenggunaRepo;
use App\Service\PenggunaService;
use App\Repository\PostinganRepo;
use App\Service\PostinganService;
use App\Service\ServAuthInterface;
use App\Repository\RepoAuthInterface;
use App\Service\ServResetPwInterface;
use App\Service\ServPenggunaInterface;
use App\Service\ServPostinganInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\RepoResetPwInterface;
use App\Repository\RepoPenggunaInterface;
use App\Repository\RepoPostinganInterface;

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
        $this->app->bind(RepoPenggunaInterface::class, PenggunaRepo::class);
        $this->app->bind(ServPenggunaInterface::class, PenggunaService::class);
        $this->app->bind(RepoPostinganInterface::class, PostinganRepo::class);
        $this->app->bind(ServPostinganInterface::class, PostinganService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

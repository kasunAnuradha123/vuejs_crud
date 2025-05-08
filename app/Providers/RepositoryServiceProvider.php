<?php

namespace App\Providers;

use App\Repositories\Eloquent\Authentication\AuthenticationRequestRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\Users\UsersRepository;
use App\Repositories\Interfaces\Authentication\AuthenticationRequestRepositoryInterface;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface ::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface ::class, UsersRepository::class);
        $this->app->bind(AuthenticationRequestRepositoryInterface ::class, AuthenticationRequestRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

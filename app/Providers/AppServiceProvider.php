<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Repositories\Interface\FeatureRepositoryInterface;
use App\Repositories\Interface\GroupRouteRepositoryInterface;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\Interface\PremiumFeatureRepositoryInterface;
use App\Repositories\Interface\PremiumRepositoryInterface;
use App\Repositories\Interface\RoleRepositoryInterface;
use App\Repositories\Interface\RouteRepositoryInterface;
use App\Repositories\Interface\ShortUrlRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Repository\FeatureRepository;
use App\Repositories\Repository\GroupRouteRepository;
use App\Repositories\Repository\PermissionRepository;
use App\Repositories\Repository\PremiumFeatureRepository;
use App\Repositories\Repository\PremiumRepository;
use App\Repositories\Repository\RoleRepository;
use App\Repositories\Repository\RouteRepository;
use App\Repositories\Repository\ShortUrlRepository;
use App\Repositories\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ShortUrlRepositoryInterface::class, ShortUrlRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, RouteRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(GroupRouteRepositoryInterface::class, GroupRouteRepository::class);
        $this->app->bind(PremiumFeatureRepositoryInterface::class, PremiumFeatureRepository::class);
        $this->app->bind(PremiumRepositoryInterface::class, PremiumRepository::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Role::observe(RoleObserver::class);

    }
}

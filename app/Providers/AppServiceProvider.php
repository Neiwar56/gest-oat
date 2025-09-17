<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Personne;
use App\Policies\PersonnePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Gate::define('is-admin', function (User $user) {
        return in_array($user->role, ['admin', 'super_admin']);
    });

    Gate::define('is-super-admin', function (User $user) {
        return $user->role === 'super_admin';
    });

    Gate::policy(Personne::class, PersonnePolicy::class);
}
}

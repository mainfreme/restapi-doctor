<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\PatientPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected array $policies = [
        User::class => PatientPolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

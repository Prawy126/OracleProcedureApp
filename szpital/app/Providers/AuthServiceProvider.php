<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', [AdminPolicy::class, 'accessAdmin']);
        Gate::define('is-logged-in', [AdminPolicy::class, 'isLoggedIn']);
        Gate::define('access-doctor', [AdminPolicy::class, 'accessDoctor']);
        Gate::define('access-nurse', [AdminPolicy::class, 'accessNurse']);
        Gate::define('access-patient', [AdminPolicy::class, 'accessPatient']);
        Log::info('YourCustomProvider booted.');
    }

}

<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Otherclasses\CustomUserGuard;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services. 
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

        Auth::extend('user', function ($app, $name, array $config) {
            return new CustomUserGuard(Auth::createUserProvider($config['provider']), $app->request, $name);
        });

        Auth::extend('researcher', function ($app, $name, array $config) {
            return new CustomUserGuard(Auth::createUserProvider($config['provider']), $app->request, $name);
        });

        Auth::extend('admin', function ($app, $name, array $config) {
            return new CustomUserGuard(Auth::createUserProvider($config['provider']), $app->request, $name);
        });
    }
}

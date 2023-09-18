<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Classes\MongoGuard;
use App\Classes\MongoGuardAuthor;
use \Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Auth::extend('mongo_guard', function ($app, $name, array $config) {
            return new MongoGuard(Auth::createUserProvider($config['provider']), $app->request, $name);
        });

        Auth::extend('mongo_guard_author', function ($app, $name, array $config) {
            return new MongoGuardAuthor(Auth::createUserProvider($config['provider']), $app->request, $name);
        });
    }
}

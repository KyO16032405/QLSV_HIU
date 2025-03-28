<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('admin', function ($user) {
            if ($user->role == 'admin') { //role admin là admin
                return true;
            }
            return false;
        });
        Gate::define('user', function ($user) {
            if (Auth::check()) { //check xem user có đang đăng nhập không
                if ($user->level != '0') { //level 0 là user
                    return true;
                } else {
                    return false;
                }
            }
        });
    }
}

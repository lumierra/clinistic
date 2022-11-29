<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('SAD', function($user){
            return $user->getAnyRole(['admin', 'spesial', 'dokter']);
        });

        Gate::define('admin', function($user){
            return $user->getAnyRole(['admin', 'spesial']);
        });

        Gate::define('dokter', function($user){
            return $user->getRole('dokter');
        });

        Gate::define('perawat', function($user){
            return $user->getRole('perawat');
        });
    }
}

<?php

namespace App\Providers;

use App\Models\NqAdmin;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('quarx', function ($user) {
            return is_a($user, NqAdmin::class);
        });

        $gate->define('view-update-search', function ($user, $search) {
            return $user->lawFirm->id === $search->hirer->lawFirm->id;
        });
    }
}

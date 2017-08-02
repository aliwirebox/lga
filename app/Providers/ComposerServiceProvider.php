<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            'App\Http\ViewComposers\AppNavigationComposer' => 'app.navigation',
            'App\Http\ViewComposers\SidebarComposer' => 'app.sidebar',
            'App\Http\ViewComposers\HirerRegistrationFormComposer' => 'app.hirer.partials.registration-form',
        ]);
        view()->composer('quarx-frontend::partials.blog-sidebar', 'App\Http\ViewComposers\BlogSidebarComposer');
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

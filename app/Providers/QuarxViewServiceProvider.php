<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class QuarxViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::addNamespace('quarx', base_path('resources/themes/backend'));
        View::addNamespace('quarx-frontend', base_path('resources/themes/default'));

        Blade::directive('theme', function ($partial) {
            return "<?php echo \$__env->make('quarx-frontend::' . {$partial}, get_defined_vars())->render(); ?>";
        });

        Blade::directive('edit', function ($module) {
            return "<?php /* edit: {$module} */ ?>";
        });
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

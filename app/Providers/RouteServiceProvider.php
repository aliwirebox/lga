<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $blogNamespace = 'App\Http\Controllers\Quarx';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        $this->loadQuarxBackendRoutes();
        $this->loadQuarxFrontendRoutes();
        $this->loadWebRoutes();
    }

    protected function loadQuarxBackendRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->blogNamespace)
            ->group(app_path('Http/quarx-backend-routes.php'));
    }

    protected function loadQuarxFrontendRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('quarx/Modules/Blogs/routes.php'));

        Route::middleware('web')
            ->group(base_path('quarx/Modules/Blogcategories/routes.php'));
    }

    protected function loadWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(app_path('Http/routes.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(app_path('Http/quarx-routes.php'));
    }
}

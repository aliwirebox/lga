<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        \Validator::extend('before_equal', function($attribute, $value, $parameters, $validator) {
            return strtotime($parameters[0]) >= strtotime($value);
        });

        \Validator::extend('after_equal', function($attribute, $value, $parameters, $validator) {
            return strtotime($parameters[0]) <= strtotime($value);
        });

        \Validator::replacer('before_equal', function($message, $attribute, $rule, $parameters) {
            $date = new Carbon($parameters[0]);
            return str_replace(':date', $date->format('F Y'), $message);
        });

        \Validator::replacer('after_equal', function($message, $attribute, $rule, $parameters) {
            $date = new Carbon($parameters[0]);
            return str_replace(':date', $date->format('F Y'), $message);
        });

        Router::macro('namespace', function ($namespace, $routes) {
            if (is_string($routes)) {
                $routes = function ($router) use ($routes, $namespace) {
                    $router->group(['namespace' => $namespace], function ($router) use ($routes) {
                        require $routes;
                    });
                };
            }

            return $this->group(['namespace' => $namespace], $routes);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Validator;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('before_equal', function($attribute, $value, $parameters, $validator) {
            return strtotime($parameters[0]) >= strtotime($value);
        });

        Validator::extend('after_equal', function($attribute, $value, $parameters, $validator) {
            return strtotime($parameters[0]) <= strtotime($value);
        });

        Validator::replacer('before_equal', function($message, $attribute, $rule, $parameters) {
            $date = new Carbon($parameters[0]);
            return str_replace(':date', $date->format('F Y'), $message);
        });

        Validator::replacer('after_equal', function($message, $attribute, $rule, $parameters) {
            $date = new Carbon($parameters[0]);
            return str_replace(':date', $date->format('F Y'), $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

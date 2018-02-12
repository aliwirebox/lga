<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
 |--------------------------------------------------------------------------
 | Configure Monolog Handlers
 |--------------------------------------------------------------------------
 |
 | This outlines how log messages should be handled in the application
 */

$app->configureMonologUsing(function ($monolog) use ($app) {
    $handler = new Monolog\Handler\RotatingFileHandler(storage_path() . '/logs/laravel.log', 60, Monolog\Logger::DEBUG);
    $handler->setFormatter(new Monolog\Formatter\LineFormatter(null, null, true, true));

    $monolog->pushHandler($handler);
    $monolog->pushProcessor(new Monolog\Processor\IntrospectionProcessor());
    $monolog->pushProcessor(new Monolog\Processor\UidProcessor());
    $monolog->pushProcessor(new Monolog\Processor\MemoryUsageProcessor());
    $monolog->pushProcessor(new Monolog\Processor\WebProcessor());

    if ($app->environment('production') || $app->environment('staging')) {
        $airbrakeNotifier = (new Kouz\Providers\AirbrakeHandler($app))->handle();
        $monologHandler = new Airbrake\MonologHandler($airbrakeNotifier, Monolog\Logger::ERROR);
        $monolog->pushHandler($monologHandler);
    }

    Monolog\ErrorHandler::register($monolog);
});

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
 */

return $app;

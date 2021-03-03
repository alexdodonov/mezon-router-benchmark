<?php
$benchmark->registerTest(function () {
    $_SERVER['REQUEST_URI'] = '/static';

    $app = new Illuminate\Container\Container();
    Illuminate\Support\Facades\Facade::setFacadeApplication($app);

    $app['app'] = $app;
    $app['env'] = 'production';

    with(new Illuminate\Events\EventServiceProvider($app))->register();

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        with(new Illuminate\Routing\RoutingServiceProvider($app))->register();
        $app['router']->get('/static', function () {
            return 'static';
        });
        $request = Illuminate\Http\Request::createFromGlobals();
        $app['router']->dispatch($request);
    }
    return microtime(true) - $startTime;
}, "[laravel] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_URI'] = '/1';

    $app = new Illuminate\Container\Container();
    Illuminate\Support\Facades\Facade::setFacadeApplication($app);

    $app['app'] = $app;
    $app['env'] = 'production';

    with(new Illuminate\Events\EventServiceProvider($app))->register();

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        with(new Illuminate\Routing\RoutingServiceProvider($app))->register();
        $app['router']->get('/{id}', function () {
            return 'param';
        });
        $request = Illuminate\Http\Request::createFromGlobals();
        $app['router']->dispatch($request);
    }
    return microtime(true) - $startTime;
}, "[laravel] Resolving param. routes %f per second\r\n");
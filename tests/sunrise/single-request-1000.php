<?php
$benchmark->registerTest(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 1000 - 1);

        $router = \Mezon\Benchmark\RouteGenerator::generateSunriseStaticRoutes(1000);

        $request = \Sunrise\Http\ServerRequest\ServerRequestFactory::fromGlobals();
        $router->handle($request);
    }
    return microtime(true) - $startTime;
}, "[sunrise/single-request/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1) . '/1';

        $router = \Mezon\Benchmark\RouteGenerator::generateSunriseNonStaticRoutes(1000);

        $request = \Sunrise\Http\ServerRequest\ServerRequestFactory::fromGlobals();
        $router->handle($request);
    }
    return microtime(true) - $startTime;
}, "[sunrise/single-request/1000 routes] Resolving param. routes %f per second\r\n");

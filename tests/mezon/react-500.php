<?php
$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generateMezonStaticRoutes(500);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router->callRoute('/static/' . rand(0, 500 - 1));
    }
    return microtime(true) - $startTime;
}, "[mezon/react/500 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(500);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router->callRoute('/param/' . rand(0, 500 - 1) . '/1');
    }
    return microtime(true) - $startTime;
}, "[mezon/react/500 routes] Resolving param. routes %f per second\r\n");

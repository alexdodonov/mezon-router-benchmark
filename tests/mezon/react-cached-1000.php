<?php
$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generateMezonStaticRoutes(1000);
    $router->warmCache();

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router->callRoute('/static/' . rand(0, 1000 - 1));
    }
    return microtime(true) - $startTime;
}, "[mezon/react-cached/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
    $router->warmCache();

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router->callRoute('/param/' . rand(0, 1000 - 1) . '/1');
    }
    return microtime(true) - $startTime;
}, "[mezon/react-cached/1000 routes] Resolving param. routes %f per second\r\n");

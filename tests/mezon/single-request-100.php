<?php
$benchmark->registerTest(function () {
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router = \Mezon\Benchmark\RouteGenerator::generateMezonStaticRoutes(100);
        $router->callRoute('/static/' . rand(0, 100 - 1));
    }
    return microtime(true) - $startTime;
}, "[mezon/single-request/100 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(100);
        $router->callRoute('/param/' . rand(0, 100 - 1) . '/1');
    }
    return microtime(true) - $startTime;
}, "[mezon/single-request/100 routes] Resolving param. routes %f per second\r\n");

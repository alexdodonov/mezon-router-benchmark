<?php
$benchmark->registerTest(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router = \Mezon\Benchmark\RouteGenerator::generatePuxStaticRoutes(1000);

        $result = $router->dispatch('/static/' . rand(0, 1000 - 1));
        $result[2]();
    }
    return microtime(true) - $startTime;
}, "[pux/single-request/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router = \Mezon\Benchmark\RouteGenerator::generatePuxNonStaticRoutes(1000);

        $result = $router->dispatch('/param/' . rand(0, 1000 - 1) . '/1');
        $result[2]();
    }
    return microtime(true) - $startTime;
}, "[pux/single-request/1000 routes] Resolving param. routes %f per second\r\n");

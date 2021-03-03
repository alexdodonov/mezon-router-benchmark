<?php
$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generatePuxStaticRoutes(1000);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $result = $router->dispatch('/static/' . rand(0, 1000 - 1));
        $result[2]();
    }
    return microtime(true) - $startTime;
}, "[pux/react/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generatePuxNonStaticRoutes(1000);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $result = $router->dispatch('/param/' . rand(0, 1000 - 1) . '/1');
        $result[2]();
    }
    return microtime(true) - $startTime;
}, "[pux/react/1000 routes] Resolving param. routes %f per second\r\n");
        
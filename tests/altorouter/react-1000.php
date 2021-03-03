<?php

$benchmark->registerTest(function () {
    $router = \Mezon\Benchmark\RouteGenerator::generateAltorouterStaticRoutes(1000);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router->match('/static/' . rand(0, 1000 - 1));
    }
    return microtime(true) - $startTime;
}, "[altorouter/react/1000 routes] Resolving static routes %f per second\r\n");
    
    $benchmark->registerTest(function () {
        $router = \Mezon\Benchmark\RouteGenerator::generateAltorouterNonStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $router->match('/param/' . rand(0, 1000 - 1) . '/1');
        }
        return microtime(true) - $startTime;
    }, "[altorouter/react/1000 routes] Resolving param. routes %f per second\r\n");
        
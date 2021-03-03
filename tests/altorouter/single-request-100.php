<?php

$benchmark->registerTest(function () {
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router = \Mezon\Benchmark\RouteGenerator::generateAltorouterStaticRoutes(100);

        $router->match('/static/' . rand(0, 100 - 1))['target']();
    }
    return microtime(true) - $startTime;
}, "[altorouter/single-request/100 routes] Resolving static routes %f per second\r\n");
    
    $benchmark->registerTest(function () {
        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $router = \Mezon\Benchmark\RouteGenerator::generateAltorouterNonStaticRoutes(100);

            $router->match('/param/' . rand(0, 100 - 1) . '/1')['target']();
        }
        return microtime(true) - $startTime;
    }, "[altorouter/single-request/100 routes] Resolving param. routes %f per second\r\n");
        
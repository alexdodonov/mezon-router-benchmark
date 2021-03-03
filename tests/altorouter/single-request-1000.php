<?php

$benchmark->registerTest(function () {
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $router = \Mezon\Benchmark\RouteGenerator::generateAltorouterStaticRoutes(1000);

        $router->match('/static/' . rand(0, 1000 - 1))['target']();
    }
    return microtime(true) - $startTime;
}, "[altorouter/single-request/1000 routes] Resolving static routes %f per second\r\n");
    
    $benchmark->registerTest(function () {
        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $router = \Mezon\Benchmark\RouteGenerator::generateAltorouterNonStaticRoutes(1000);

            $router->match('/param/' . rand(0, 1000 - 1) . '/1')['target']();
        }
        return microtime(true) - $startTime;
    }, "[altorouter/single-request/1000 routes] Resolving param. routes %f per second\r\n");
        
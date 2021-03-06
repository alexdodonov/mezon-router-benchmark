<?php
$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generatePhrouteStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $router->dispatch('GET', parse_url('/static/' . rand(1, 1000), PHP_URL_PATH));
        }
        return microtime(true) - $startTime;
    },
    "[phroute/react/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generatePhrouteNonStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $router->dispatch('GET', parse_url('/param/' . rand(1, 1000) . '/1', PHP_URL_PATH));
        }
        return microtime(true) - $startTime;
    },
    "[phroute/react/1000 routes] Resolving param. routes %f per second\r\n");
        
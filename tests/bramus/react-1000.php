<?php

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generateBramusStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 1000 - 1);
            $router->run();
        }
        return microtime(true) - $startTime;
    },
    "[bramus/react/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generateBramusNonStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1).'/1';
            $router->run();
        }
        return microtime(true) - $startTime;
    },
    "[bramus/react/1000 routes] Resolving param. routes %f per second\r\n");
        
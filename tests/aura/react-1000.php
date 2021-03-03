<?php
$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generateAuraStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 1000 - 1);
            $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER);
            $route = $router->match($request);
            $route->handler($request);
        }
        return microtime(true) - $startTime;
    },
    "[aura/react/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generateAuraNonStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1) . '/1';
            $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER);
            $route = $router->match($request);
            $route->handler($request);
        }
        return microtime(true) - $startTime;
    },
    "[aura/react/1000 routes] Resolving param. routes %f per second\r\n");
        
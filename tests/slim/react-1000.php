<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generateSlimStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 1000 - 1);
            $router->run();
        }
        return microtime(true) - $startTime;
    },
    "[slim/react/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $router = \Mezon\Benchmark\RouteGenerator::generateSlimNonStaticRoutes(1000);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1) . '/1';
            $router->run();
        }
        return microtime(true) - $startTime;
    },
    "[slim/react/1000 routes] Resolving param. routes %f per second\r\n");
        
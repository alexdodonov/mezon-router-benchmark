<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 1000 - 1);

            $router = \Mezon\Benchmark\RouteGenerator::generateLeagueStaticRoutes(1000);

            $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
            $router->dispatch($request);
        }
        return microtime(true) - $startTime;
    },
    "[league/single-request/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1) . '/1';

            $router = \Mezon\Benchmark\RouteGenerator::generateLeagueNonStaticRoutes(1000);

            $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
            $router->dispatch($request);
        }
        return microtime(true) - $startTime;
    },
    "[league/single-request/1000 routes] Resolving param. routes %f per second\r\n");

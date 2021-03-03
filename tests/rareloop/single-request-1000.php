<?php
use Symfony\Component\HttpFoundation\Request;
use Laminas\Diactoros\RequestFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $router = \Mezon\Benchmark\RouteGenerator::generateRareloopStaticRoutes(1000);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 1000 - 1);
        $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();
        $router->match($request);
    }
    return microtime(true) - $startTime;
}, "[rareloop/single-request/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $router = \Mezon\Benchmark\RouteGenerator::generateRareloopNonStaticRoutes(1000);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1) . '/1';
        $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();
        $router->match($request);
    }
    return microtime(true) - $startTime;
}, "[rareloop/single-request/1000 routes] Resolving param. routes %f per second\r\n");

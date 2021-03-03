<?php
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_URI'] = '/static/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1);

    $staticRoutes = \Mezon\Benchmark\RouteGenerator::generateSymfonyStaticRoutes(1000);

    $staticContext = new RequestContext();
    $staticContext->fromRequest(Request::createFromGlobals());

    $staticMatcher = new UrlMatcher($staticRoutes, $staticContext);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $staticMatcher->match('/static/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1))['controller']();
    }
    return microtime(true) - $startTime;
}, "[symfony/react/url-matcher/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_URI'] = '/param/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1) . '/1';

    $paramRoutes = \Mezon\Benchmark\RouteGenerator::generateSymfonyNonStaticRoutes(1000);

    $paramContext = new RequestContext();
    $paramContext->fromRequest(Request::createFromGlobals());

    $paramMatcher = new UrlMatcher($paramRoutes, $paramContext);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $paramMatcher->match('/param/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1) . '/1')['controller']();
    }
    return microtime(true) - $startTime;
}, "[symfony/react/url-matcher/1000 routes] Resolving param. routes %f per second\r\n");
<?php
use Symfony\Component\Routing\Matcher\CompiledUrlMatcher;
use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherDumper;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_URI'] = '/static/' . rand(0, 500 - 1);

    $staticRoutes = \Mezon\Benchmark\RouteGenerator::generateSymfonyStaticRoutes(500);

    $dumper = new CompiledUrlMatcherDumper($staticRoutes);

    $requestContext = new RequestContext();
    $requestContext->fromRequest(Request::createFromGlobals());

    $staticMatcher = new CompiledUrlMatcher($dumper->getCompiledRoutes(), $requestContext);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $staticMatcher->match('/static/' . rand(0, 500 - 1))['controller']();
    }
    return microtime(true) - $startTime;
}, "[symfony/react/compiled-url-matcher/500 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 500 - 1) . '/1';

    $paramRoutes = \Mezon\Benchmark\RouteGenerator::generateSymfonyNonStaticRoutes(500);

    $dumper = new CompiledUrlMatcherDumper($paramRoutes);

    $requestContext = new RequestContext();
    $requestContext->fromRequest(Request::createFromGlobals());

    $paramMatcher = new CompiledUrlMatcher($dumper->getCompiledRoutes(), $requestContext);

    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $paramMatcher->match('/param/' . rand(0, 500 - 1) . '/1')['controller']();
    }
    return microtime(true) - $startTime;
}, "[symfony/react/compiled-url-matcher/500 routes] Resolving param. routes %f per second\r\n");

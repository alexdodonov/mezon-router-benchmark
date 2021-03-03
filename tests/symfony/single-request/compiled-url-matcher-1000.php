<?php
use Symfony\Component\Routing\Matcher\CompiledUrlMatcher;
use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherDumper;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

// warm up the cache with static routes
$staticRoutes = \Mezon\Benchmark\RouteGenerator::generateSymfonyStaticRoutes(1000);
$dumperStatic = new CompiledUrlMatcherDumper($staticRoutes);
file_put_contents(
    __DIR__ . '/../../../cache/static-cache.php',
    '<?php return ' . var_export($dumperStatic->getCompiledRoutes(), true) . ';');

// warm up the cache with non-static routes
$paramRoutes = \Mezon\Benchmark\RouteGenerator::generateSymfonyNonStaticRoutes(1000);
$dumperParam = new CompiledUrlMatcherDumper($paramRoutes);
file_put_contents(
    __DIR__ . '/../../../cache/param-cache.php',
    '<?php return ' . var_export($dumperParam->getCompiledRoutes(), true) . ';');

// and here is the benchmark
$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_URI'] = '/static/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1);

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $requestContext = new RequestContext();
            $requestContext->fromRequest(Request::createFromGlobals());

            $compiledRoutes = require __DIR__ . '/../../../cache/static-cache.php';

            $staticMatcher = new CompiledUrlMatcher($compiledRoutes, $requestContext);
            $staticMatcher->match('/static/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1))['controller']();
        }
        return microtime(true) - $startTime;
    },
    "[symfony/single-request/compiled-url-matcher/1000 routes] Resolving static routes %f per second\r\n");

$benchmark->registerTest(
    function () {
        $_SERVER['REQUEST_URI'] = '/param/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1) . '/1';

        $startTime = microtime(true);
        for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
            $requestContext = new RequestContext();
            $requestContext->fromRequest(Request::createFromGlobals());

            $compiledRoutes = require __DIR__ . '/../../../cache/param-cache.php';

            $paramMatcher = new CompiledUrlMatcher($compiledRoutes, $requestContext);
            $paramMatcher->match('/param/' . rand(0, \Mezon\Benchmark\Base::$iterationsAmount - 1) . '/1')['controller']();
        }
        return microtime(true) - $startTime;
    },
    "[symfony/single-request/compiled-url-matcher/1000 routes] Resolving param. routes %f per second\r\n");

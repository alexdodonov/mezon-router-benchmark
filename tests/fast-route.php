<?php
$benchmark->registerTest(function () {
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/static', function () {
                return 'static';
            });
        });
        $routeInfo = $dispatcher->dispatch('GET', '/static');
        $routeInfo[1]();
    }
    return microtime(true) - $startTime;
}, "[fast-route] Resolving static routes %f per second\r\n");

$benchmark->registerTest(function () {
    $startTime = microtime(true);
    for ($i = 0; $i < \Mezon\Benchmark\Base::$iterationsAmount; $i ++) {
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/{id:\d+}', function () {
                return 'param';
            });
        });
        $routeInfo = $dispatcher->dispatch('GET', '/1');
        $routeInfo[1]();
    }
    return microtime(true) - $startTime;
}, "[fast-route] Resolving param. routes %f per second\r\n");

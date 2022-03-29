<?php
namespace Mezon\Benchmarks\Snappy;

use Mezon\Benchmark\RouteGenerator;

class SnappySingleRequestStaticBench
{

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only static routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function benchStatic(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/0';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        $router = RouteGenerator::generateSnappyStaticRoutes(1000);
        $router->handleRoute();
    }
}

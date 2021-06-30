<?php
namespace Mezon\Benchmarks\Zaphpa;

use Mezon\Benchmark\RouteGenerator;

class ZaphpaReactStaticBench
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
        $router = RouteGenerator::generateZaphpaStaticRoutes(1000);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/0';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        $router->route();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        $router->route();
    }
}

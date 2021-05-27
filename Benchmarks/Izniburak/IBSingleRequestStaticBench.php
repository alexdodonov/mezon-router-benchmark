<?php
namespace Mezon\Benchmarks\Izniburak;

use Mezon\Benchmark\RouteGenerator;

class IBSingleRequestStaticBench
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
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);
        $router->run();
    }
}

<?php
namespace Mezon\Benchmarks\Toro;

use Mezon\Benchmark\RouteGenerator;

class ToroSingleRequestStaticBench
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
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        $routes = RouteGenerator::generateToroStaticRoutes(1000);
        \Toro::serve($routes);
    }
}

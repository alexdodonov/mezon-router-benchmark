<?php
namespace Mezon\Benchmarks\Toro;

use Mezon\Benchmark\RouteGenerator;

class ToroReactParamBench
{

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only static routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function benchParam(): void
    {
        $routes = RouteGenerator::generateToroNonStaticRoutes(1000);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/0/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/99/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/199/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/299/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/399/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/499/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/599/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/699/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/799/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/899/1/';
        \Toro::serve($routes);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/999/1/';
        \Toro::serve($routes);
    }
}

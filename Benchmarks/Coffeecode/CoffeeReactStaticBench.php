<?php
namespace Mezon\Benchmarks\Coffeecode;

use Mezon\Benchmark\RouteGenerator;

class CoffeeReactStaticBench
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
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $_GET['route'] = '/static/0';
        $router->dispatch();

        $_GET['route'] = '/static/99';
        $router->dispatch();

        $_GET['route'] = '/static/199';
        $router->dispatch();

        $_GET['route'] = '/static/299';
        $router->dispatch();

        $_GET['route'] = '/static/399';
        $router->dispatch();

        $_GET['route'] = '/static/499';
        $router->dispatch();

        $_GET['route'] = '/static/599';
        $router->dispatch();

        $_GET['route'] = '/static/699';
        $router->dispatch();

        $_GET['route'] = '/static/799';
        $router->dispatch();

        $_GET['route'] = '/static/899';
        $router->dispatch();

        $_GET['route'] = '/static/999';
        $router->dispatch();
    }
}

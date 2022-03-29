<?php
namespace Mezon\Benchmarks\Coffeecode;

use Mezon\Benchmark\RouteGenerator;

class CoffeeSingleRequestStaticBench
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
        $_GET['route'] = '/static/0';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/99';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/199';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/299';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/399';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/499';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/599';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/699';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/799';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/899';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/static/999';
        $router = RouteGenerator::generateCoffeeStaticRoutes(1000);
        $router->dispatch();
    }
}

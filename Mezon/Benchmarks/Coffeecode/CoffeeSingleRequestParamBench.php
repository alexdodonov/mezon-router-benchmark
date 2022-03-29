<?php
namespace Mezon\Benchmarks\Coffeecode;

use Mezon\Benchmark\RouteGenerator;

class CoffeeSingleRequestParamBench
{

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only param routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function benchParam(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/0/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/99/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/199/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/299/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/399/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/499/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/599/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/699/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/799/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/899/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['route'] = '/param/999/1';
        $router = RouteGenerator::generateCoffeeNonStaticRoutes(1000);
        $router->dispatch();
    }
}

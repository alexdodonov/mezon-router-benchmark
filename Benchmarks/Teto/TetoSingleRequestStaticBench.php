<?php
namespace Mezon\Benchmarks\Teto;

use Mezon\Benchmark\RouteGenerator;

class TetoSingleRequestStaticBench
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
        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/0');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/99');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/199');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/299');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/399');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/499');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/599');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/699');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/799');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/899');

        $router = RouteGenerator::generateTetoStaticRoutes(1000);
        $router->match('GET', '/static/999');
    }
}

<?php
namespace Mezon\Benchmarks\Macaw;

use Mezon\Benchmark\RouteGenerator;
use NoahBuscher\Macaw\Macaw;

class MacawSingleRequestStaticBench
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
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        RouteGenerator::generateMacawStaticRoutes(1000);
        Macaw::dispatch();
    }
}

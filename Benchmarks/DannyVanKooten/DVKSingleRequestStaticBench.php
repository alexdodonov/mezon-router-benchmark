<?php
namespace Mezon\Benchmarks\DannyVanKooten;

use Mezon\Benchmark\RouteGenerator;

class DVKSingleRequestStaticBench
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

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/0';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/99';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/199';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/299';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/399';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/499';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/599';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/699';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/799';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/899';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/static/999';
        $router->matchCurrentRequest();
    }
}

<?php
namespace Mezon\Benchmarks\DannyVanKooten;

use Mezon\Benchmark\RouteGenerator;

class DVKReactStaticBench
{

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only static routes are checked
     *
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchStatic(): void
    {
        $router = RouteGenerator::generateDVKStaticRoutes(1000);
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $_SERVER['REQUEST_URI'] = '/static/0';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/99';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/199';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/299';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/399';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/499';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/599';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/699';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/799';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/899';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/static/999';
        $router->matchCurrentRequest();
    }
}

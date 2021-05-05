<?php
namespace Mezon\Benchmarks\DannyVanKooten;

use Mezon\Benchmark\RouteGenerator;

class DVKReactParamBench
{

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only param routes are checked
     *
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchParam(): void
    {
        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $_SERVER['REQUEST_URI'] = '/param/0/1/';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/99/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/199/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/299/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/399/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/499/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/599/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/699/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/799/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/899/1';
        $router->matchCurrentRequest();

        $_SERVER['REQUEST_URI'] = '/param/999/1';
        $router->matchCurrentRequest();
    }
}

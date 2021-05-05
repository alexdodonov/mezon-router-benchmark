<?php
namespace Mezon\Benchmarks\DannyVanKooten;

use Mezon\Benchmark\RouteGenerator;

class DVKSingleRequestParamBench
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
        
        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/0/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/99/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/199/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/299/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/399/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/499/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/599/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/699/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/799/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/899/1';
        $router->matchCurrentRequest();

        $router = RouteGenerator::generateDVKNonStaticRoutes(1000);
        $_SERVER['REQUEST_URI'] = '/param/999/1';
        $router->matchCurrentRequest();
    }
}

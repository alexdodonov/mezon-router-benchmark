<?php
namespace Mezon\Benchmarks\Teto;

use Mezon\Benchmark\RouteGenerator;

class TetoReactParamBench
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
        $router = RouteGenerator::generateTetoNonStaticRoutes(1000);

        $router->match('GET', '/param/0/1');

        $router->match('GET', '/param/99/1');

        $router->match('GET', '/param/199/1');

        $router->match('GET', '/param/299/1');

        $router->match('GET', '/param/399/1');

        $router->match('GET', '/param/499/1');

        $router->match('GET', '/param/599/1');

        $router->match('GET', '/param/699/1');

        $router->match('GET', '/param/799/1');

        $router->match('GET', '/param/899/1');

        $router->match('GET', '/param/999/1');
    }
}

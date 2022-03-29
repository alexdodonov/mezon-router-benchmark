<?php
namespace Mezon\Benchmarks\Hoa;

use Mezon\Benchmark\RouteGenerator;

class HoaSingleRequestParamBench
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

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/0/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/99/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/199/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/299/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/399/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/499/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/599/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/699/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/799/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/899/1';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaNonStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/param/999/1';
        $dispatcher->dispatch($router);
    }
}

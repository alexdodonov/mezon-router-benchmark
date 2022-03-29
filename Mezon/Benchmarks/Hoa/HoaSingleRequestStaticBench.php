<?php
namespace Mezon\Benchmarks\Hoa;

use Mezon\Benchmark\RouteGenerator;

class HoaSingleRequestStaticBench
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

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/0';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/99';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/199';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/299';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/399';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/499';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/599';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/699';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/799';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/899';
        $dispatcher->dispatch($router);

        $router = RouteGenerator::generateHoaStaticRoutes(1000);
        $dispatcher = new \Hoa\Dispatcher\Basic();
        $_SERVER['argv'][1] = '/static/999';
        $dispatcher->dispatch($router);
    }
}

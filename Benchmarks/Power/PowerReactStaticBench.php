<?php
namespace Mezon\Benchmarks\Power;

use Mezon\Benchmark\RouteGenerator;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response;

class PowerReactStaticBench
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
        $router = RouteGenerator::generatePowerStaticRoutes(1000);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/0';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
    }
}

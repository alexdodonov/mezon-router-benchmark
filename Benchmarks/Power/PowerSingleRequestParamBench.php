<?php
namespace Mezon\Benchmarks\Power;

use Mezon\Benchmark\RouteGenerator;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response;

class PowerSingleRequestParamBench
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
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/0/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/99/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/199/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/299/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/399/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/499/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/599/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/699/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/799/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/899/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
        
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/999/1/';
        $router = RouteGenerator::generatePowerNonStaticRoutes(1000);
        $request = ServerRequestFactory::fromGlobals();
        $router->start($request, new Response());
    }
}

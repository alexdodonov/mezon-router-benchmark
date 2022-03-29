<?php
namespace Mezon\Benchmarks\Izniburak;

use Mezon\Benchmark\RouteGenerator;
use Symfony\Component\HttpFoundation\Request;

class IBReactStaticBench
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
        $router = RouteGenerator::generateIzniburakStaticRoutes(1000);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/0/';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/99';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/199';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/299';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/399';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/499';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/599';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/699';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/799';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/899';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/static/999';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();
    }
}

<?php
namespace Mezon\Benchmarks\Izniburak;

use Mezon\Benchmark\RouteGenerator;
use Symfony\Component\HttpFoundation\Request;

class IBReactParamBench
{
    
    /**
     * Router with the non-static routes
     *
     * @var \Buki\Router\Router
     */
    private $router = null;
    
    /**
     * Setup
     */
    public function setUp(): void
    {
        $this->router = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->warmCache();
    }

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
        $router = RouteGenerator::generateIzniburakNonStaticRoutes(1000);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/0/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/99/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/199/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/299/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/399/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/499/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/599/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/699/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/799/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/899/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/param/999/1';
        $router->getRequest()->setRequest(Request::createFromGlobals());
        $router->run();
    }
}

<?php
namespace Mezon\Benchmarks\Pecee;

use Pecee\Http\Url;
use Mezon\Benchmark\RouteGenerator;

class PeceeSingleRequestParamBench
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
        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/0/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/99/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/199/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/299/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/399/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/499/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/599/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/699/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/799/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/899/1'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router = RouteGenerator::generatePeceeNonStaticRoutes(1000);
        $router->getRequest()->setUrl(new Url('/param/999/1'));
        $router->getRequest()->setMethod('get');
        $router->start();
    }
}

<?php
namespace Mezon\Benchmarks\Pecee;

use Mezon\Benchmark\RouteGenerator;
use Pecee\Http\Url;

class PeceeReactStaticBench
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
        $router = RouteGenerator::generatePeceeStaticRoutes(1000);

        $router->getRequest()->setUrl(new Url('/static/0'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/99'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/199'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/299'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/399'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/499'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/599'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/699'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/799'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/899'));
        $router->getRequest()->setMethod('get');
        $router->start();

        $router->getRequest()->setUrl(new Url('/static/999'));
        $router->getRequest()->setMethod('get');
        $router->start();
    }
}

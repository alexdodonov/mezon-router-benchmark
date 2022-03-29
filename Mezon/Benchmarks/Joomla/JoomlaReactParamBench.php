<?php
namespace Mezon\Benchmarks\Joomla;

use Mezon\Benchmark\RouteGenerator;

class JoomlaReactParamBench
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
        $router = RouteGenerator::generateJoomlaNonStaticRoutes(1000);
        $controller = $router->getController('/param/1/0');
        $controller->execute();

        $controller = $router->getController('/param/1/99');
        $controller->execute();

        $controller = $router->getController('/param/1/199');
        $controller->execute();

        $controller = $router->getController('/param/1/299');
        $controller->execute();

        $controller = $router->getController('/param/1/399');
        $controller->execute();

        $controller = $router->getController('/param/1/499');
        $controller->execute();

        $controller = $router->getController('/param/1/599');
        $controller->execute();

        $controller = $router->getController('/param/1/699');
        $controller->execute();

        $controller = $router->getController('/param/1/799');
        $controller->execute();

        $controller = $router->getController('/param/1/899');
        $controller->execute();

        $controller = $router->getController('/param/1/999');
        $controller->execute();
    }
}

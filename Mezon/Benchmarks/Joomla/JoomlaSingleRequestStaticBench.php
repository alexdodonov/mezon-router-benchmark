<?php
namespace Mezon\Benchmarks\Joomla;

use Mezon\Benchmark\RouteGenerator;

class JoomlaSingleRequestStaticBench
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
        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/0');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/99');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/199');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/299');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/399');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/499');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/599');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/699');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/799');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/899');
        $controller->execute();

        $router = RouteGenerator::generateJoomlaStaticRoutes(1000);
        $controller = $router->getController('/static/999');
        $controller->execute();
    }
}

<?php
namespace Mezon\Benchmarks2\Symfony\CompiledUrlMatcher;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\Dumper\CompiledUrlMatcherDumper;
use Symfony\Component\Routing\Matcher\CompiledUrlMatcher;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class Utils
{

    /**
     * Callback method
     */
    public static function callback(): void
    {}

    /**
     * Method builds URL matcher
     *
     * @return UrlMatcher
     */
    public static function buildMatcher(): UrlMatcher
    {
        $routeCollection = new RouteCollection();

        $routes = json_decode(file_get_contents(__DIR__ . '/../Data/SymfonyRoutes.json'), true);

        foreach ($routes as $i => $route) {
            if (isset($route['params'])) {
                $routeObject = new Route($route['route'], [
                    'controller' => '\Mezon\Benchmarks2\Symfony\UrlMatcher\Utils::callback'
                ], $route['params']);
            } else {
                $routeObject = new Route($route['route'], [
                    'controller' => '\Mezon\Benchmarks2\Symfony\UrlMatcher\Utils::callback'
                ]);
            }

            $routeCollection->add('route-' . $i, $routeObject);
        }

        $dumper = new CompiledUrlMatcherDumper($routeCollection);

        $requestContext = new RequestContext();
        $requestContext->fromRequest(Request::createFromGlobals());

        return new CompiledUrlMatcher($dumper->getCompiledRoutes(), $requestContext);
    }
}

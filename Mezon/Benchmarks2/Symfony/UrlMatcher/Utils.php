<?php
namespace Mezon\Benchmarks2\Symfony\UrlMatcher;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $requestContext = new RequestContext();
        $requestContext->fromRequest(Request::createFromGlobals());

        return new UrlMatcher($routeCollection, $requestContext);
    }
}

<?php
namespace Mezon\Benchmark;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Klein\Klein;
use Pux;
use Pecee\SimpleRouter\Route\RouteUrl;

function staticCallback(): string
{
    return 'static';
}

function paramCallback(): string
{
    return 'param';
}

function callbackPsr7(Request $request, Response $response): Response
{
    return $response;
}

function callbackPsr7Response(): \Laminas\Diactoros\Response
{
    return new \Laminas\Diactoros\Response();
}

/**
 * Class provides routes generations routines
 */
class RouteGenerator
{

    function callbackSymfony(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\HttpFoundation\Response $response)
    {
        return $response;
    }

    /**
     * Method generates static routes for the Symfony router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return RouteCollection collection of routes
     */
    public static function generateSymfonyStaticRoutes(int $amount): RouteCollection
    {
        $routeCollection = new RouteCollection();

        for ($i = 0; $i < $amount; $i ++) {
            $static = new Route('/static/' . $i, [
                'controller' => '\Mezon\Benchmark\staticCallback'
            ]);

            $routeCollection->add('static-' . $i, $static);
        }

        return $routeCollection;
    }

    /**
     * Method generates non-static routes for the Symfony router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return RouteCollection collection of routes
     */
    public static function generateSymfonyNonStaticRoutes(int $amount): RouteCollection
    {
        $routeCollection = new RouteCollection();

        for ($i = 0; $i < $amount; $i ++) {
            $static = new Route('/param/' . $i . '/{id}', [
                'controller' => '\Mezon\Benchmark\paramCallback'
            ], [
                'id' => '[0-9]+'
            ]);

            $routeCollection->add('param-' . $i, $static);
        }

        return $routeCollection;
    }

    /**
     * Method generates static routes for the Mezon router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Mezon\Router\Router router
     */
    public static function generateMezonStaticRoutes(int $amount): \Mezon\Router\Router
    {
        $router = new \Mezon\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->addRoute('/static/' . $i, '\Mezon\Benchmark\staticCallback', 'GET');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Mezon router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Mezon\Router\Router router
     */
    public static function generateMezonNonStaticRoutes(int $amount): \Mezon\Router\Router
    {
        $router = new \Mezon\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->addRoute('/param/' . $i . '/[i:id]', '\Mezon\Benchmark\paramCallback', 'GET');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Mezon router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \AltoRouter router
     */
    public static function generateAltorouterStaticRoutes(int $amount): \AltoRouter
    {
        $router = new \AltoRouter();

        for ($i = 0; $i < $amount; $i ++) {
            $router->map('GET', '/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Mezon router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \AltoRouter router
     */
    public static function generateAltorouterNonStaticRoutes(int $amount): \AltoRouter
    {
        $router = new \AltoRouter();

        for ($i = 0; $i < $amount; $i ++) {
            $router->map('GET', '/param/' . $i . '/[i:id]', '\Mezon\Benchmark\paramCallback');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Slim router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Slim\App router
     */
    public static function generateSlimStaticRoutes(int $amount): \Slim\App
    {
        $router = AppFactory::create();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/static/' . $i, '\Mezon\Benchmark\callbackPsr7');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Slim router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Slim\App router
     */
    public static function generateSlimNonStaticRoutes(int $amount): \Slim\App
    {
        $router = AppFactory::create();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/param/' . $i . '/{id}', '\Mezon\Benchmark\callbackPsr7');
        }

        return $router;
    }

    /**
     * Method generates static routes for the League router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \League\Route\Router router
     */
    public static function generateLeagueStaticRoutes(int $amount): \League\Route\Router
    {
        $router = new \League\Route\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/static/' . $i, '\Mezon\Benchmark\callbackPsr7Response');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the League router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \League\Route\Router router
     */
    public static function generateLeagueNonStaticRoutes(int $amount): \League\Route\Router
    {
        $router = new \League\Route\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/param/' . $i . '/{id}', '\Mezon\Benchmark\callbackPsr7Response');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Klein router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return Klein router
     */
    public static function generateKleinStaticRoutes(int $amount): Klein
    {
        $router = new \Klein\Klein();

        for ($i = 0; $i < $amount; $i ++) {
            $router->respond('GET', '/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Klein router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return Klein router
     */
    public static function generateKleinNonStaticRoutes(int $amount): Klein
    {
        $router = new \Klein\Klein();

        for ($i = 0; $i < $amount; $i ++) {
            $router->respond('GET', '/param/' . $i . '/[i:id]', '\Mezon\Benchmark\paramCallback');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Bramus router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Bramus\Router\Router router
     */
    public static function generateBramusStaticRoutes(int $amount): \Bramus\Router\Router
    {
        $router = new \Bramus\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Bramus router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Bramus\Router\Router router
     */
    public static function generateBramusNonStaticRoutes(int $amount): \Bramus\Router\Router
    {
        $router = new \Bramus\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/param/' . $i . '/{id}', '\Mezon\Benchmark\paramCallback');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Aura router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Aura\Router\Matcher router
     */
    public static function generateAuraStaticRoutes(int $amount): \Aura\Router\Matcher
    {
        $router = new \Aura\Router\RouterContainer();
        $map = $router->getMap();

        for ($i = 0; $i < $amount; $i ++) {
            $map->get('static.' . $i, '/static/' . $i, '\Mezon\Benchmark\callbackPsr7Response');
        }

        return $router->getMatcher();
    }

    /**
     * Method generates non-static routes for the Aura router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Aura\Router\Matcher router
     */
    public static function generateAuraNonStaticRoutes(int $amount): \Aura\Router\Matcher
    {
        $router = new \Aura\Router\RouterContainer();
        $map = $router->getMap();

        for ($i = 0; $i < $amount; $i ++) {
            $map->get('param' . $i, '/param/' . $i . '/{id}', '\Mezon\Benchmark\callbackPsr7Response');
        }

        return $router->getMatcher();
    }

    /**
     * Method generates static routes for the Phroute router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Phroute\Phroute\Dispatcher
     */
    public static function generatePhrouteStaticRoutes(int $amount): \Phroute\Phroute\Dispatcher
    {
        $router = new \Phroute\Phroute\RouteCollector();

        for ($i = 1; $i <= $amount; $i ++) {
            $router->get('/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return new \Phroute\Phroute\Dispatcher($router->getData());
    }

    /**
     * Method generates non-static routes for the Phroute router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Phroute\Phroute\Dispatcher
     */
    public static function generatePhrouteNonStaticRoutes(int $amount): \Phroute\Phroute\Dispatcher
    {
        $router = new \Phroute\Phroute\RouteCollector();

        for ($i = 1; $i <= $amount; $i ++) {
            $router->get('/param/' . $i . '/{id}', '\Mezon\Benchmark\paramCallback');
        }

        return new \Phroute\Phroute\Dispatcher($router->getData());
    }

    /**
     * Method generates static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return Pux\Mux
     */
    public static function generatePuxStaticRoutes(int $amount): \Pux\Mux
    {
        $router = new \Pux\Mux();

        for ($i = 0; $i < $amount; $i ++) {
            $router->any('/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Pux\Mux
     */
    public static function generatePuxNonStaticRoutes(int $amount): \Pux\Mux
    {
        $router = new \Pux\Mux();

        for ($i = 0; $i < $amount; $i ++) {
            $router->any('/param/' . $i . '/:id', '\Mezon\Benchmark\paramCallback', [
                'require' => [
                    'id' => '\d+'
                ],
                'default' => [
                    'id' => '1'
                ]
            ]);
        }

        return $router;
    }

    /**
     * Method generates static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Sunrise\Http\Router\Router
     */
    public static function generateSunriseStaticRoutes(int $amount): \Sunrise\Http\Router\Router
    {
        $collector = new \Sunrise\Http\Router\RouteCollector();

        for ($i = 0; $i < $amount; $i ++) {
            $collector->get('home' . $i, '/static/' . $i, new \Sunrise\Http\Router\RequestHandler\CallableRequestHandler(function ($request) {
                return (new \Sunrise\Http\Message\ResponseFactory())->createJsonResponse(200, [
                    'status' => 'ok'
                ]);
            }));
        }

        $router = new \Sunrise\Http\Router\Router();
        $router->addRoute(...$collector->getCollection()
            ->all());

        return $router;
    }

    /**
     * Method generates non-static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Sunrise\Http\Router\Router
     */
    public static function generateSunriseNonStaticRoutes(int $amount): \Sunrise\Http\Router\Router
    {
        $collector = new \Sunrise\Http\Router\RouteCollector();

        for ($i = 0; $i < $amount; $i ++) {
            $collector->get('home' . $i, '/param/' . $i . '/{id<\d+>}', new \Sunrise\Http\Router\RequestHandler\CallableRequestHandler(function ($request) {
                return (new \Sunrise\Http\Message\ResponseFactory())->createJsonResponse(200, [
                    'status' => 'ok'
                ]);
            }));
        }

        $router = new \Sunrise\Http\Router\Router();
        $router->addRoute(...$collector->getCollection()
            ->all());

        return $router;
    }

    /**
     * Method generates static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Rareloop\Router\Router
     */
    public static function generateRareloopStaticRoutes(int $amount): \Rareloop\Router\Router
    {
        $router = new \Rareloop\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->map([
                'GET'
            ], '/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Rareloop\Router\Router
     */
    public static function generateRareloopNonStaticRoutes(int $amount): \Rareloop\Router\Router
    {
        $router = new \Rareloop\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->map([
                'GET'
            ], '/param/' . $i . '/{id}', '\Mezon\Benchmark\paramCallback');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Hoa\Router\Http
     */
    public static function generateHoaStaticRoutes(int $amount): \Hoa\Router\Http
    {
        $router = new \Hoa\Router\Http();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('s' . $i, '/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Hoa\Router\Http
     */
    public static function generateHoaNonStaticRoutes(int $amount): \Hoa\Router\Http
    {
        $router = new \Hoa\Router\Http();

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('p' . $i, '/param/' . $i . '/(?<id>\d+)', '\Mezon\Benchmark\paramCallback');
        }

        return $router;
    }

    /**
     * Some controller method
     */
    public function staticController(): string
    {
        return 'static';
    }

    /**
     * Some controller method
     */
    public function paramController(): string
    {
        return 'param';
    }

    /**
     * Method generates static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \PHPRouter\Router
     */
    public static function generateDVKStaticRoutes(int $amount): \PHPRouter\Router
    {
        $collection = new \PHPRouter\RouteCollection();

        for ($i = 0; $i < $amount; $i ++) {
            $collection->attachRoute(new \PHPRouter\Route('/static/' . $i, [
                '_controller' => '\Mezon\Benchmark\RouteGenerator::staticController',
                'methods' => 'GET'
            ]));
        }

        return new \PHPRouter\Router($collection);
    }

    /**
     * Method generates non-static routes for the Pux router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \PHPRouter\Router
     */
    public static function generateDVKNonStaticRoutes(int $amount): \PHPRouter\Router
    {
        $collection = new \PHPRouter\RouteCollection();

        for ($i = 0; $i < $amount; $i ++) {
            $collection->attachRoute(new \PHPRouter\Route('/param/' . $i . '/:id/', [
                '_controller' => '\Mezon\Benchmark\RouteGenerator::paramController',
                'methods' => 'GET'
            ]));
        }

        return new \PHPRouter\Router($collection);
    }

    /**
     * Method generates static routes for the Pecee router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Pecee\SimpleRouter\Router
     */
    public static function generatePeceeStaticRoutes(int $amount): \Pecee\SimpleRouter\Router
    {
        $router = new \Pecee\SimpleRouter\Router();
        $router->reset();

        for ($i = 0; $i < $amount; $i ++) {
            $route = new RouteUrl('/static/' . $i, '\Mezon\Benchmark\RouteGenerator::staticController');
            $route->setRequestMethods([
                \Pecee\Http\Request::REQUEST_TYPE_GET
            ]);
            $router->addRoute($route);
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Pecee router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Pecee\SimpleRouter\Router
     */
    public static function generatePeceeNonStaticRoutes(int $amount): \Pecee\SimpleRouter\Router
    {
        $router = new \Pecee\SimpleRouter\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $route = new RouteUrl('/param/' . $i . '/{id}/', '\Mezon\Benchmark\RouteGenerator::paramController');
            $route->setRequestMethods([
                \Pecee\Http\Request::REQUEST_TYPE_GET
            ]);
            $router->addRoute($route);
        }

        return $router;
    }

    /**
     * Method generates static routes for the Coffee router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \CoffeeCode\Router\Router
     */
    public static function generateCoffeeStaticRoutes(int $amount): \CoffeeCode\Router\Router
    {
        $router = new \CoffeeCode\Router\Router('http://localhost');

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/static/' . $i, '\Mezon\Benchmark\RouteGenerator::staticController');
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Coffee router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \CoffeeCode\Router\Router
     */
    public static function generateCoffeeNonStaticRoutes(int $amount): \CoffeeCode\Router\Router
    {
        $router = new \CoffeeCode\Router\Router('http://localhost');

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/param/' . $i . '/{id}/', '\Mezon\Benchmark\RouteGenerator::paramController');
        }

        return $router;
    }

    /**
     * Method generates static routes for the Steampixel router
     *
     * @param int $amount
     *            amount of routes to be generated
     */
    public static function generateSteampixelStaticRoutes(int $amount): void
    {
        \Steampixel\Route::$routes = [];

        for ($i = 0; $i < $amount; $i ++) {
            \Steampixel\Route::add('/static/' . $i, '\Mezon\Benchmark\RouteGenerator::staticController');
        }
    }

    /**
     * Method generates non-static routes for the Steampixel router
     *
     * @param int $amount
     *            amount of routes to be generated
     */
    public static function generateSteampixelNonStaticRoutes(int $amount): void
    {
        \Steampixel\Route::$routes = [];

        for ($i = 0; $i < $amount; $i ++) {
            \Steampixel\Route::add('/param/' . $i . '/([0-9]*)/', '\Mezon\Benchmark\RouteGenerator::paramController');
        }
    }

    /**
     * Method generates static routes for the Steampixel router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Buki\Router\Router router
     */
    public static function generateIzniburakStaticRoutes(int $amount): \Buki\Router\Router
    {
        $router = new \Buki\Router\Router();
        $closure = function ($request = null, $response = null) {
            return $response;
        };

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/static/' . $i, $closure);
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Steampixel router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Buki\Router\Router router
     */
    public static function generateIzniburakNonStaticRoutes(int $amount): \Buki\Router\Router
    {
        $router = new \Buki\Router\Router();
        $closure = function ($request = null, $response = null) {
            return $response;
        };

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/param/' . $i . '/:id/', $closure);
        }

        return $router;
    }
}

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
use MiladRahimi\PhpContainer\Container;
use Psr\Container\ContainerInterface;
use MiladRahimi\PhpRouter\Routing\Repository;
use MiladRahimi\PhpRouter\Publisher\Publisher;
use Mcustiel\PowerRoute\Common\Factories\MatcherFactory;
use Mcustiel\Creature\SingletonLazyCreator;
use Mcustiel\PowerRoute\Matchers\Equals;
use Mcustiel\PowerRoute\Common\Factories\InputSourceFactory;
use Mcustiel\PowerRoute\Common\Factories\ActionFactory;
use Mcustiel\PowerRoute\PowerRoute;
use Mcustiel\PowerRoute\Common\Conditions\ConditionsMatcherFactory;
use Mcustiel\PowerRoute\Matchers\RegExp;
use Mcustiel\PowerRoute\InputSources\Url;
use Mcustiel\PowerRoute\Actions\ActionInterface;
use Mcustiel\PowerRoute\Common\TransactionData;
use Joomla\Application\AbstractApplication;
use Joomla\Controller\ControllerInterface;
use Joomla\Input\Input;
use NoahBuscher\Macaw\Macaw;
use Vectorface\SnappyRouter\Config\Config;
use Vectorface\SnappyRouter\Handler\ControllerHandler;
use Vectorface\SnappyRouter\Handler\PatternMatchHandler;

class EmptyPublisher implements Publisher
{

    public function publish($response): void
    {
        // do nothing
    }
}

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

class StaticAction implements ActionInterface
{

    public function execute(TransactionData $transactionData, $argument = null)
    {
        $transactionData->setResponse('static');
    }
}

class NonStaticAction implements ActionInterface
{

    public function execute(TransactionData $transactionData, $argument = null)
    {
        $transactionData->setResponse('param');
    }
}

class RouteHandler
{

    public function get(): string
    {
        return 'param';
    }
}

class JiraRouteHandler implements ControllerInterface
{

    public function get(): string
    {
        return 'param';
    }

    public function getApplication()
    {}

    public function setApplication(AbstractApplication $app)
    {}

    public function serialize()
    {}

    public function unserialize($serialized)
    {}

    public function getInput()
    {}

    public function execute()
    {}

    public function setInput(Input $input)
    {}
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

    /**
     * Method generates static routes for the Steampixel router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \MiladRahimi\PhpRouter\Router
     */
    public static function generateMiladRahimiStaticRoutes(int $amount): \MiladRahimi\PhpRouter\Router
    {
        $container = new Container();
        $container->singleton(Container::class, $container);
        $container->singleton(ContainerInterface::class, $container);
        $container->singleton(Repository::class, new Repository());
        $container->singleton(Publisher::class, EmptyPublisher::class);

        $router = $container->instantiate(\MiladRahimi\PhpRouter\Router::class);

        $closure = function () {
            return 'static';
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
     * @return \MiladRahimi\PhpRouter\Router router
     */
    public static function generateMiladRahimiNonStaticRoutes(int $amount): \MiladRahimi\PhpRouter\Router
    {
        $container = new Container();
        $container->singleton(Container::class, $container);
        $container->singleton(ContainerInterface::class, $container);
        $container->singleton(Repository::class, new Repository());
        $container->singleton(Publisher::class, EmptyPublisher::class);

        $router = $container->instantiate(\MiladRahimi\PhpRouter\Router::class);

        $closure = function (): string {
            return 'param';
        };

        for ($i = 0; $i < $amount; $i ++) {
            $router->get('/param/' . $i . '/{id}/', $closure);
        }

        return $router;
    }

    /**
     * Method generates static routes for the router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Mcustiel\PowerRoute\PowerRoute
     */
    public static function generatePowerStaticRoutes(int $amount): \Mcustiel\PowerRoute\PowerRoute
    {
        $matcherFactory = new MatcherFactory([
            'regExp' => new SingletonLazyCreator(RegExp::class),
            'equals' => new SingletonLazyCreator(Equals::class)
        ]);
        $inputSourceFactory = new InputSourceFactory([
            'get' => new SingletonLazyCreator(Url::class)
        ]);
        $actionFactory = new ActionFactory([
            'static' => new SingletonLazyCreator(StaticAction::class)
        ]);

        $config = [
            'start' => 'urls',
            'nodes' => [
                'urls' => [
                    'condition' => [
                        'one-of' => []
                    ],
                    'actions' => [
                        'if-matches' => [
                            [
                                'static' => null
                            ]
                        ],
                        'else' => [
                            [
                                'notFound' => null
                            ]
                        ]
                    ]
                ]
            ]
        ];

        for ($i = 0; $i < $amount; $i ++) {
            $config['nodes']['urls']['condition']['one-of'][] = [
                'input-source' => [
                    'get' => 'path'
                ],
                'matcher' => [
                    'equals' => '/static/' . $i
                ]
            ];
        }

        return new PowerRoute($config, $actionFactory, new ConditionsMatcherFactory($inputSourceFactory, $matcherFactory));
    }

    /**
     * Method generates static routes for the router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Mcustiel\PowerRoute\PowerRoute
     */
    public static function generatePowerNonStaticRoutes(int $amount): \Mcustiel\PowerRoute\PowerRoute
    {
        $matcherFactory = new MatcherFactory([
            'regExp' => new SingletonLazyCreator(RegExp::class),
            'equals' => new SingletonLazyCreator(Equals::class)
        ]);
        $inputSourceFactory = new InputSourceFactory([
            'get' => new SingletonLazyCreator(Url::class)
        ]);
        $actionFactory = new ActionFactory([
            'static' => new SingletonLazyCreator(StaticAction::class)
        ]);

        $config = [
            'start' => 'urls',
            'nodes' => [
                'urls' => [
                    'condition' => [
                        'one-of' => []
                    ],
                    'actions' => [
                        'if-matches' => [
                            [
                                'static' => null
                            ]
                        ],
                        'else' => [
                            [
                                'notFound' => null
                            ]
                        ]
                    ]
                ]
            ]
        ];

        for ($i = 0; $i < $amount; $i ++) {
            $config['nodes']['urls']['condition']['one-of'][] = [
                'input-source' => [
                    'get' => 'path'
                ],
                'matcher' => [
                    'equals' => '/param/' . $i . '/1/'
                ]
            ];
        }

        return new PowerRoute($config, $actionFactory, new ConditionsMatcherFactory($inputSourceFactory, $matcherFactory));
    }

    /**
     * Method generates static routes for the ToroPHP router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return array routes
     */
    public static function generateToroStaticRoutes(int $amount): array
    {
        $routes = [];

        for ($i = 0; $i < $amount; $i ++) {
            $routes['/static/' . $i] = RouteHandler::class;
        }

        return $routes;
    }

    /**
     * Method generates non-static routes for the ToroPHP router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return array routes
     */
    public static function generateToroNonStaticRoutes(int $amount): array
    {
        $routes = [];

        for ($i = 0; $i < $amount; $i ++) {
            $routes['/param/' . $i . '/:number/'] = RouteHandler::class;
        }

        return $routes;
    }

    /**
     * Method generates static routes for the Zaphpa router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Zaphpa\Router router
     */
    public static function generateZaphpaStaticRoutes(int $amount): \Zaphpa\Router
    {
        $router = new \Zaphpa\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->addRoute([
                'path' => '/static/' . $i,
                'get' => [
                    RouteHandler::class,
                    'get'
                ]
            ]);
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Zaphpa router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Zaphpa\Router routes
     */
    public static function generateZaphpaNonStaticRoutes(int $amount): \Zaphpa\Router
    {
        $router = new \Zaphpa\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->addRoute([
                'path' => '/param/' . $i . '/{id}/',
                'get' => [
                    RouteHandler::class,
                    'get'
                ]
            ]);
        }

        return $router;
    }

    /**
     * Method generates static routes for the Joomla router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Joomla\Router\Router router
     */
    public static function generateJoomlaStaticRoutes(int $amount): \Joomla\Router\Router
    {
        $router = new \Joomla\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->addMap('/static/' . $i, JiraRouteHandler::class);
        }

        return $router;
    }

    /**
     * Method generates non-static routes for the Joomla router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Joomla\Router\Router routes
     */
    public static function generateJoomlaNonStaticRoutes(int $amount): \Joomla\Router\Router
    {
        $router = new \Joomla\Router\Router();

        for ($i = 0; $i < $amount; $i ++) {
            $router->addMap('/param/' . $i . '/:id/', JiraRouteHandler::class);
        }

        return $router;
    }

    /**
     * Method generates static routes for the Teto router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Teto\Routing\Router router
     */
    public static function generateTetoStaticRoutes(int $amount): \Teto\Routing\Router
    {
        $routingMap = [];

        for ($i = 0; $i < $amount; $i ++) {
            $routingMap[] = [
                'GET',
                '/static/' . $i,
                '/static/' . $i
            ];
        }

        return new \Teto\Routing\Router($routingMap);
    }

    /**
     * Method generates non-static routes for the Teto router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Teto\Routing\Router routes
     */
    public static function generateTetoNonStaticRoutes(int $amount): \Teto\Routing\Router
    {
        $routingMap = [];

        for ($i = 0; $i < $amount; $i ++) {
            $routingMap[] = [
                'GET',
                '/param/' . $i . '/:id/',
                '/param/' . $i . '/:id/',
                [
                    'id' => '/\A(\d+)\z/'
                ]
            ];
        }

        return new \Teto\Routing\Router($routingMap);
    }

    /**
     * Method generates static routes for the Leaf router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Leaf\App router
     */
    public static function generateLeafStaticRoutes(int $amount): \Leaf\App
    {
        $app = new \Leaf\App();

        for ($i = 0; $i < $amount; $i ++) {
            $app->get('/static/' . $i, '\Mezon\Benchmark\staticCallback');
        }

        return $app;
    }

    /**
     * Method generates non-static routes for the Leaf router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Leaf\App routes
     */
    public static function generateLeafNonStaticRoutes(int $amount): \Leaf\App
    {
        $app = new \Leaf\App();

        for ($i = 0; $i < $amount; $i ++) {
            $app->get('/param/' . $i . '/{id}/', '\Mezon\Benchmark\paramCallback');
        }

        return $app;
    }

    /**
     * Method generates static routes for the Macaw router
     *
     * @param int $amount
     *            amount of routes to be generated
     */
    public static function generateMacawStaticRoutes(int $amount): void
    {
        Macaw::$maps = [];
        Macaw::$routes = [];
        Macaw::$methods = [];
        Macaw::$callbacks = [];

        $closure = function (): string {
            return 'static';
        };

        for ($i = 0; $i < $amount; $i ++) {
            Macaw::get('/static/' . $i, $closure);
        }
    }

    /**
     * Method generates non-static routes for the Macaw router
     *
     * @param int $amount
     *            amount of routes to be generated
     */
    public static function generateMacawNonStaticRoutes(int $amount): void
    {
        Macaw::$maps = [];
        Macaw::$routes = [];
        Macaw::$methods = [];
        Macaw::$callbacks = [];

        $closure = function (): string {
            return 'param';
        };

        for ($i = 0; $i < $amount; $i ++) {
            Macaw::get('/param/' . $i . '/(:num)', $closure);
        }
    }

    /**
     * Method generates static routes for the Snappy router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Vectorface\SnappyRouter\SnappyRouter router
     */
    public static function generateSnappyStaticRoutes(int $amount): \Vectorface\SnappyRouter\SnappyRouter
    {
        $routes = [];

        $closure = function (): string {
            return 'static';
        };

        for ($i = 0; $i < $amount; $i ++) {
            $routes['/static/{id:[0-9]+}'] = [
                'get' => $closure
            ];
        }

        $config = new Config([
            Config::KEY_HANDLERS => [
                'PatternHandler' => [
                    Config::KEY_CLASS => 'Vectorface\\SnappyRouter\\Handler\\PatternMatchHandler',
                    Config::KEY_OPTIONS => [
                        PatternMatchHandler::KEY_ROUTES => $routes
                    ]
                ]
            ]
        ]);

        return new \Vectorface\SnappyRouter\SnappyRouter($config);
    }

    /**
     * Method generates non-static routes for the Snappy router
     *
     * @param int $amount
     *            amount of routes to be generated
     * @return \Vectorface\SnappyRouter\SnappyRouter router
     */
    public static function generateSnappyNonStaticRoutes(int $amount): \Vectorface\SnappyRouter\SnappyRouter
    {
        $routes = [];

        $closure = function (): string {
            return 'param';
        };

        for ($i = 0; $i < $amount; $i ++) {
            $routes['/param/' . $i . '/{id:[0-9]+}'] = [
                'get' => $closure
            ];
        }

        $config = new Config([
            Config::KEY_HANDLERS => [
                'PatternHandler' => [
                    Config::KEY_CLASS => 'Vectorface\\SnappyRouter\\Handler\\PatternMatchHandler',
                    Config::KEY_OPTIONS => [
                        PatternMatchHandler::KEY_ROUTES => $routes
                    ]
                ]
            ]
        ]);

        return new \Vectorface\SnappyRouter\SnappyRouter($config);
    }
}

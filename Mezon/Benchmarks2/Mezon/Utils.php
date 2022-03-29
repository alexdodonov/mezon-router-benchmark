<?php
namespace Mezon\Benchmarks2\Mezon;

use Mezon\Router\Router;

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
     * Method generates routes for the Mezon router
     *
     * @return Router router
     */
    public static function generateMezonRoutes(): Router
    {
        $routes = json_decode(file_get_contents(__DIR__ . '/Data/MezonRoutes.json'), false);
        $router = new Router();

        foreach ($routes as $route) {
            $router->addRoute($route, '\Mezon\Benchmarks2\Mezon\Utils::callback', 'GET');
        }

        return $router;
    }
}

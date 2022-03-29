<?php
namespace Mezon\Benchmarks2\Mezon;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonReactBench
{

    /**
     * Router with the non-static routes
     *
     * @var Router
     */
    private $router = null;

    /**
     * Setup
     */
    public function setUp(): void
    {
        $this->router = Utils::generateMezonRoutes();
        $this->router->warmCache();
    }

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only param routes are checked
     *
     * @Revs(100)
     * @Iterations(10)
     */
    public function bench(): void
    {
        // languages/[s:locale]/back
        $this->router->callRoute('/languages/ru/back');

        // auth/roles
        $this->router->callRoute('/auth/roles');

        // settings/categories/create
        $this->router->callRoute('/settings/categories/create');

        // modals/taxes/[i:tax]
        $this->router->callRoute('/modals/taxes/12345');
    }
}

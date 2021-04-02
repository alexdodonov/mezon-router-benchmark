<?php
namespace Mezon\Benchmarks\Mezon;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonReactParamBench
{

    /**
     * Router with the non-static routes
     *
     * @var Router
     */
    private $paramRoutes = null;

    /**
     * Setup
     */
    public function setUp(): void
    {
        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->warmCache();
    }

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only param routes are checked
     *
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchParam(): void
    {
        $this->paramRoutes->callRoute('/param/0/1');
        $this->paramRoutes->callRoute('/param/99/1');
        $this->paramRoutes->callRoute('/param/199/1');
        $this->paramRoutes->callRoute('/param/299/1');
        $this->paramRoutes->callRoute('/param/399/1');
        $this->paramRoutes->callRoute('/param/499/1');
        $this->paramRoutes->callRoute('/param/599/1');
        $this->paramRoutes->callRoute('/param/699/1');
        $this->paramRoutes->callRoute('/param/799/1');
        $this->paramRoutes->callRoute('/param/899/1');
        $this->paramRoutes->callRoute('/param/999/1');
    }
}

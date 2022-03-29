<?php
namespace Mezon\Benchmarks\Mezon;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonReactStaticBench
{

    /**
     * Router with the static routes
     *
     * @var Router
     */
    private $staticRoutes = null;

    /**
     * Setup
     */
    public function setUp(): void
    {
        $this->staticRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonStaticRoutes(1000);
        $this->staticRoutes->warmCache();
    }

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only static routes are checked
     *
     * @Revs(100)
     * @Iterations(10)
     */
    public function benchStatic(): void
    {
        $this->staticRoutes->callRoute('/static/0');
        $this->staticRoutes->callRoute('/static/99');
        $this->staticRoutes->callRoute('/static/199');
        $this->staticRoutes->callRoute('/static/299');
        $this->staticRoutes->callRoute('/static/399');
        $this->staticRoutes->callRoute('/static/499');
        $this->staticRoutes->callRoute('/static/599');
        $this->staticRoutes->callRoute('/static/699');
        $this->staticRoutes->callRoute('/static/799');
        $this->staticRoutes->callRoute('/static/899');
        $this->staticRoutes->callRoute('/static/999');
    }
}

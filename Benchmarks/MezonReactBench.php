<?php
namespace Mezon\Benchmarks;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonReactBench
{

    /**
     * Router with the static routes
     *
     * @var Router
     */
    private $staticRoutes = null;

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
        $this->staticRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonStaticRoutes(1000);
        $this->staticRoutes->warmCache();

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->warmCache();
    }

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only static routes are checked
     *
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchReactStatic(): void
    {
        $this->staticRoutes->callRoute('/static/' . rand(0, 1000 - 1));
    }

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only param routes are checked
     *
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchReactParam(): void
    {
        $this->paramRoutes->callRoute('/param/' . rand(0, 1000 - 1) . '/1');
    }
}

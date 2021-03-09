<?php
namespace Mezon\Benchmarks;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonSingleBench
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
        $this->staticRoutes->dumpOnDisk('./cache/cache.static.php');
        $this->staticRoutes->clear();

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->dumpOnDisk('./cache/cache.param.php');
        $this->paramRoutes->clear();
    }

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only static routes are checked
     *
     * @Revs(1000)
     * @Iterations(10)
     */
    public function benchSingleRequestStatic(): void
    {
        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/' . rand(0, 1000 - 1));
    }

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only param routes are checked
     *
     * @Revs(200)
     * @Iterations(10)
     */
    public function benchSingleRequestParam(): void
    {
        $this->paramRoutes->loadFromDisk('./cache/cache.param.php');
        $this->paramRoutes->callRoute('/param/' . rand(0, 1000 - 1) . '/1');
    }
}

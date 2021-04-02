<?php
namespace Mezon\Benchmarks\Mezon;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonSingleRequestStaticBench
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
        $this->staticRoutes->dumpOnDisk('./cache/cache.static.php');
        $this->staticRoutes->clear();
    }

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only static routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function benchStatic(): void
    {
        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/0');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/99');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/199');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/299');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/399');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/499');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/599');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/699');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/799');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/899');

        $this->staticRoutes->loadFromDisk('./cache/cache.static.php');
        $this->staticRoutes->callRoute('/static/999');
    }
}

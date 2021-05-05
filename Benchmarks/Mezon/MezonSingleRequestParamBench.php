<?php
namespace Mezon\Benchmarks\Mezon;

use Mezon\Router\Router;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class MezonSingleRequestParamBench
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
        $this->paramRoutes->dumpOnDisk('./cache/cache.param.php');
        $this->paramRoutes->clear();
    }

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only param routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function benchParam(): void
    {
        // $this->paramRoutes->loadFromDisk('./cache/cache.param.php');
        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/0/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/99/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/199/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/299/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/399/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/499/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/599/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/699/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/799/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/899/1');

        $this->paramRoutes = \Mezon\Benchmark\RouteGenerator::generateMezonNonStaticRoutes(1000);
        $this->paramRoutes->callRoute('/param/999/1');
    }
}

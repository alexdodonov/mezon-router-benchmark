<?php
namespace Mezon\Benchmarks\Steampixel;

use Mezon\Benchmark\RouteGenerator;

class SteampixelSingleRequestStaticBench
{

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
        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/0');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/99');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/199');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/299');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/399');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/499');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/599');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/699');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/799');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/899');

        RouteGenerator::generateSteampixelStaticRoutes(1000);
        \Steampixel\Route::run('/static/999');
    }
}

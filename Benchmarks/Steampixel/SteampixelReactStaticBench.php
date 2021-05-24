<?php
namespace Mezon\Benchmarks\Steampixel;

use Mezon\Benchmark\RouteGenerator;

class SteampixelReactStaticBench
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
        RouteGenerator::generateSteampixelNonStaticRoutes(1000);
        \Steampixel\Route::run('/static/0');

        \Steampixel\Route::run('/static/99');

        \Steampixel\Route::run('/static/199');

        \Steampixel\Route::run('/static/299');

        \Steampixel\Route::run('/static/399');

        \Steampixel\Route::run('/static/499');

        \Steampixel\Route::run('/static/599');

        \Steampixel\Route::run('/static/699');

        \Steampixel\Route::run('/static/799');

        \Steampixel\Route::run('/static/899');

        \Steampixel\Route::run('/static/999');
    }
}

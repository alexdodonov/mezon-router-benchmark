<?php
namespace Mezon\Benchmarks\Steampixel;

use Mezon\Benchmark\RouteGenerator;

class SteampixelReactParamBench
{

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only static routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function benchParam(): void
    {
        RouteGenerator::generateSteampixelNonStaticRoutes(1000);
        \Steampixel\Route::run('/param/0/1');

        \Steampixel\Route::run('/param/99/1');

        \Steampixel\Route::run('/param/199/1');

        \Steampixel\Route::run('/param/299/1');

        \Steampixel\Route::run('/param/399/1');

        \Steampixel\Route::run('/param/499/1');

        \Steampixel\Route::run('/param/599/1');

        \Steampixel\Route::run('/param/699/1');

        \Steampixel\Route::run('/param/799/1');

        \Steampixel\Route::run('/param/899/1');

        \Steampixel\Route::run('/param/999/1');
    }
}

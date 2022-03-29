<?php
namespace Mezon\Benchmarks2\Mezon;

class MezonSingleRequestBench
{

    /**
     * Benchmarking the case when we setup router each time the HTTP request is processed
     *
     * Only param routes are checked
     *
     * @Revs(10)
     * @Iterations(10)
     */
    public function bench(): void
    {
        // languages/[s:locale]/back
        $router = Utils::generateMezonRoutes();
        $router->callRoute('/languages/ru/back');

        // auth/roles
        $router = Utils::generateMezonRoutes();
        $router->callRoute('/auth/roles');

        // settings/categories/create
        $router = Utils::generateMezonRoutes();
        $router->callRoute('/settings/categories/create');

        // modals/taxes/[i:tax]
        $router = Utils::generateMezonRoutes();
        $router->callRoute('/modals/taxes/12345');
    }
}

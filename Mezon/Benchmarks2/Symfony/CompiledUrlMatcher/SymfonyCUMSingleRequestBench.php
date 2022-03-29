<?php
namespace Mezon\Benchmarks2\Symfony\CompiledUrlMatcher;

class SymfonyCUMSingleRequestBench
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
        $router = Utils::buildMatcher();
        $router->match('/languages/ru/back')['controller']();

        // auth/roles
        $router = Utils::buildMatcher();
        $router->match('/auth/roles')['controller']();

        // settings/categories/create
        $router = Utils::buildMatcher();
        $router->match('/settings/categories/create')['controller']();

        // modals/taxes/[i:tax]
        $router = Utils::buildMatcher();
        $router->match('/modals/taxes/12345')['controller']();
    }
}

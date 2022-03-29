<?php
namespace Mezon\Benchmarks2\Symfony\CompiledUrlMatcher;

use Symfony\Component\Routing\Matcher\UrlMatcher;

/**
 *
 * @BeforeMethods({"setUp"})
 */
class SymfonyCUMReactBench
{

    /**
     * Router with the non-static routes
     *
     * @var UrlMatcher
     */
    private $router = null;

    /**
     * Setup
     */
    public function setUp(): void
    {
        $this->router = Utils::buildMatcher();
    }

    /**
     * Benchmarking the case when we setup router once and then process inbound requests
     *
     * Only param routes are checked
     *
     * @Revs(100)
     * @Iterations(10)
     */
    public function bench(): void
    {
        // languages/[s:locale]/back
        $this->router->match('/languages/ru/back')['controller']();

        // auth/roles
        $this->router->match('/auth/roles')['controller']();

        // settings/categories/create
        $this->router->match('/settings/categories/create')['controller']();

        // modals/taxes/[i:tax]
        $this->router->match('/modals/taxes/12345')['controller']();
    }
}

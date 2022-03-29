<?php
namespace Mezon\Benchmarks;

/**
 * Class for organizing benchmarks
 *
 * @author gdever
 */
class Base
{

    /**
     * Variadic iterations count
     *
     * @var integer
     */
    public static $iterationsAmount = 10;

    /**
     * List of test-cases
     *
     * @var array
     */
    private $testCases = [];

    /**
     * Method inits one test in benchmark
     *
     * @param callable $callback
     *            test case
     * @param string $message
     *            message wich will be outputted at the end of the test case execution
     */
    public function registerTest(callable $callback, string $message): void
    {
        $this->testCases[] = [
            'test-case' => $callback,
            'message' => $message
        ];
    }

    /**
     * Methodd runs all test-cases
     */
    public function run(): void
    {
        foreach ($this->testCases as $testCase) {
            $duration = $testCase['test-case']();
            print(sprintf($testCase['message'], Base::$iterationsAmount / $duration));
        }
    }
}

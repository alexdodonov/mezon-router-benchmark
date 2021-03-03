<?php
require_once (__DIR__ . '/vendor/autoload.php');
require_once (__DIR__ . '/vendor/illuminate/support/helpers.php');

// initial setup
$_SERVER['REQUEST_METHOD'] = 'GET';

$benchmark = new \Mezon\Benchmark\Base();

require_once(__DIR__.'/tests/altorouter/react-1000.php');
require_once(__DIR__.'/tests/altorouter/single-request-1000.php');
require_once(__DIR__.'/tests/mezon/react-1000.php');
require_once(__DIR__.'/tests/mezon/single-request-1000.php');
require_once(__DIR__.'/tests/symfony/react/compiled-url-matcher-1000.php');
require_once(__DIR__.'/tests/symfony/react/url-matcher-1000.php');
require_once(__DIR__.'/tests/symfony/single-request/compiled-url-matcher-1000.php');
require_once(__DIR__.'/tests/symfony/single-request/url-matcher-1000.php');

$benchmark->run();

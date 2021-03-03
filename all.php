<?php
require_once (__DIR__ . '/vendor/autoload.php');
require_once (__DIR__ . '/vendor/illuminate/support/helpers.php');

// initial setup
$_SERVER['REQUEST_METHOD'] = 'GET';

$benchmark = new \Mezon\Benchmark\Base();

require_once(__DIR__.'/tests/rareloop/single-request-1000.php');
require_once(__DIR__.'/tests/rareloop/react-1000.php');
require_once(__DIR__.'/tests/phroute/single-request-1000.php');
require_once(__DIR__.'/tests/phroute/react-1000.php');
require_once(__DIR__.'/tests/mezon/single-request-1000.php');
require_once(__DIR__.'/tests/mezon/react-1000.php');
require_once(__DIR__.'/tests/mezon/react-cached-1000.php');
require_once(__DIR__.'/tests/sunrise/single-request-1000.php');
require_once(__DIR__.'/tests/sunrise/react-1000.php');
require_once(__DIR__.'/tests/pux/single-request-1000.php');
require_once(__DIR__.'/tests/pux/react-1000.php');
require_once(__DIR__.'/tests/slim/single-request-1000.php');
require_once(__DIR__.'/tests/slim/react-1000.php');
require_once(__DIR__.'/tests/aura/single-request-1000.php');
require_once(__DIR__.'/tests/aura/react-1000.php');
require_once(__DIR__.'/tests/bramus/single-request-1000.php');
require_once(__DIR__.'/tests/bramus/react-1000.php');
require_once(__DIR__.'/tests/klein/single-request-1000.php');
require_once(__DIR__.'/tests/klein/react-1000.php');
require_once(__DIR__.'/tests/altorouter/single-request-1000.php');
require_once(__DIR__.'/tests/altorouter/react-1000.php');
require_once(__DIR__.'/tests/league/single-request-1000.php');
require_once(__DIR__.'/tests/league/react-1000.php');

// TODO add Symfony
// TODO add Laravel
// TODO add FastRoute

$benchmark->run();

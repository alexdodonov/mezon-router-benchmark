<?php
use Mezon\Benchmark\RouteGenerator;

require_once (__DIR__ . '/vendor/autoload.php');
require_once (__DIR__ . '/vendor/illuminate/support/helpers.php');

// initial setup
$_SERVER['REQUEST_METHOD'] = 'GET';

/**$mezonRouter = RouteGenerator::generateMezonNonStaticRoutes(1000);

for ($i = 0; $i < 100; $i ++) {
    $mezonRouter->callRoute('/param/' . rand(0, 1000 - 1) . '/1');
}*/

$slimRouter = RouteGenerator::generateSlimNonStaticRoutes(1000);

for ($i = 0; $i < 100; $i ++) {
    $_SERVER['REQUEST_URI'] = '/param/' . rand(0, 1000 - 1) . '/1';
    $slimRouter->run();
}
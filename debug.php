<?php
require_once(__DIR__.'/vendor/autoload.php');
require_once(__DIR__.'/Benchmarks/MiladRahimi/MiladSingleRequestParamBench.php');

use Mezon\Benchmark\RouteGenerator;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response;

$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = '/static/11110';
$router = RouteGenerator::generatePowerNonStaticRoutes(1000);
$request = ServerRequestFactory::fromGlobals();
$router->start($request, new Response());
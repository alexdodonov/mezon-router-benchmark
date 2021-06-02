<?php
require_once(__DIR__.'/vendor/autoload.php');
require_once(__DIR__.'/Benchmarks/MiladRahimi/MiladSingleRequestParamBench.php');

use Mezon\Benchmarks\MiladRahimi\MiladSingleRequestParamBench;

$benchmark = new MiladSingleRequestParamBench();
$benchmark->benchParam();
<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

$binList = new \App\Services\BinList\BinList();
$compute = new \App\CommisionCalculator\DefaultComputeCommision();
$rate = new \App\Services\ExchangeRate\ExchangeRate();


$calculator = new  App\CommisionCalculator\CommisionCalculator($binList,$compute, $rate);

$calculator->calculate($argv[1]);

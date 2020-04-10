<?php
declare(strict_types=1);

namespace Tests\Unit\CommissionCalculator;

use App\CommissionCalculator\CommissionCalculator;
use App\Interfaces\ComputeCommissionInterface;
use App\Services\BinList\BinListInterface;
use App\Services\ExchangeRate\ExchangeRateInterface;
use App\Services\IOService\DTO\CommissionResource;
use App\Services\IOService\Interfaces\InputInterface;
use App\Services\IOService\Interfaces\OutputInterface;
use Tests\AbstractTestCase;

/**
 * @covers \App\CommissionCalculator\CommissionCalculator
 */
final class CommissionCalculatorTest extends AbstractTestCase
{
    public function testCalculate(): void
    {
        $json = '{"bin":"45717360","amount":"100.00","currency":"EUR"}';
        $jsonArray = \json_decode($json, true);

        $resource = new CommissionResource();
        $resource->setAmount($jsonArray['amount']);
        $resource->setBin($jsonArray['bin']);
        $resource->setCurrency($jsonArray['currency']);

        $binList = \Mockery::mock(BinListInterface::class);
        $binList->shouldReceive('getAlpha')->once()->andReturn('DK');

        $exchangeRate = \Mockery::mock(ExchangeRateInterface::class);
        $exchangeRate->shouldReceive('getRate')->once()->andReturn('0');

        $compute = \Mockery::mock(ComputeCommissionInterface::class);
        $compute->shouldReceive('compute')->once()->andReturn('1.00');

        $input = \Mockery::mock(InputInterface::class);
        $input->shouldReceive('getCommissionDetail')->once()->andReturn([$resource]);

        $output = \Mockery::mock(OutputInterface::class);
        $output->shouldReceive('addOutput')->once();

        $calculate = new CommissionCalculator($binList, $compute, $exchangeRate, $input, $output);

        \file_put_contents('sample.txt', $json);

        $result = $calculate->calculate('sample.txt');

        self::assertInstanceOf(OutputInterface::class, $result);

        unlink('sample.txt');
    }
}

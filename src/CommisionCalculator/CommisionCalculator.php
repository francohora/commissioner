<?php
declare(strict_types=1);

namespace App\CommisionCalculator;

use App\Interfaces\CommisionCalculatorInterface;
use App\Interfaces\ComputeCommisionInterface;
use App\Interfaces\CurrencyValidatorInterface;
use App\Services\BinList\BinListInterface;
use App\Services\ExchangeRate\ExchangeRateInterface;

final class CommisionCalculator implements CommisionCalculatorInterface
{
    private $config;

    /**
     * @var \App\Services\BinList\BinListInterface
     */
    private $binList;

    /**
     * @var \App\Interfaces\ComputeCommisionInterface
     */
    private $computeCommision;

    /**
     * @var \App\Services\ExchangeRate\ExchangeRateInterface
     */
    private $exchangeRate;

    public function __construct(
        BinListInterface $binList,
        ComputeCommisionInterface $computeCommision,
        ExchangeRateInterface $exchangeRate
    ) {
        $this->binList = $binList;
        $this->computeCommision = $computeCommision;
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @param string $input
     *
     * @throws \Exception
     */
    public function calculate(string $input)
    {
        if (\file_exists($input) === false) {
            throw new \Exception('Not Existing');
        }

        foreach (file($input, FILE_SKIP_EMPTY_LINES) as $row) {
            $detail = json_decode($row, true);

            $alpha = $this->binList->getAlpha($detail['bin']);

            $rate = $this->exchangeRate->getRate($detail['currency']);

            echo $this->computeCommision->compute($detail['amount'], $rate, $alpha), "\n";
        }
    }
}

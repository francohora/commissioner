<?php
declare(strict_types=1);

namespace App\CommissionCalculator;

use App\Interfaces\CommissionCalculatorInterface;
use App\Interfaces\ComputeCommissionInterface;
use App\Services\BinList\BinListInterface;
use App\Services\ExchangeRate\ExchangeRateInterface;
use App\Services\IOService\Interfaces\InputInterface;
use App\Services\IOService\Interfaces\OutputInterface;

final class CommissionCalculator implements CommissionCalculatorInterface
{
    /**
     * @var \App\Services\BinList\BinListInterface
     */
    private $binList;

    /**
     * @var \App\Interfaces\ComputeCommissionInterface
     */
    private $computeCommission;

    /**
     * @var \App\Services\ExchangeRate\ExchangeRateInterface
     */
    private $exchangeRate;

    /**
     * @var \App\Services\IOService\Interfaces\InputInterface
     */
    private $input;

    /**
     * @var \App\Services\IOService\Interfaces\OutputInterface
     */
    private $output;

    public function __construct(
        BinListInterface $binList,
        ComputeCommissionInterface $computeCommission,
        ExchangeRateInterface $exchangeRate,
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->binList = $binList;
        $this->computeCommission = $computeCommission;
        $this->exchangeRate = $exchangeRate;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @param string $input
     *
     * @return \App\Services\IOService\Interfaces\OutputInterface
     *
     * @throws \Exception
     */
    public function calculate(string $input)
    {
        foreach ($this->input->getCommissionDetail($input) as $row) {
            $alpha = $this->binList->getAlpha($row->getBin());

            $rate = $this->exchangeRate->getRate($row->getCurrency());

            $this->output->addOutput($this->computeCommission->compute($row->getAmount(), $rate, $alpha));
        }

        return $this->output;
    }
}

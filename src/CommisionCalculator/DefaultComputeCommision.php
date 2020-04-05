<?php
declare(strict_types=1);

namespace App\CommisionCalculator;

use App\CurrencyValidator\CurrencyValidator;
use App\Interfaces\ComputeCommisionInterface;

final class DefaultComputeCommision implements ComputeCommisionInterface
{
    private $config;

    private $validator;

    public function __construct()
    {
        $this->config = require_once 'config/commission.php';

        $this->validator = new CurrencyValidator();
    }

    public function compute(string $amount, string $rate, string $alpha): string
    {
        $commissionRate = $this->validator->validate($alpha) ? $this->config['ratio']['eu'] : $this->config['ratio']['non-eu'];

        $amountFixed = ($alpha === 'EUR' || $rate === '0')? $amount : bcdiv($amount, $rate);

        return bcmul($amountFixed, (string)$commissionRate,2);
    }
}

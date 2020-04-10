<?php
declare(strict_types=1);

namespace App\CommissionCalculator;

use App\Interfaces\ComputeCommissionInterface;
use App\Services\CurrencyValidator\CurrencyValidatorInterface;

final class DefaultComputeCommission implements ComputeCommissionInterface
{
    private $ratio;

    private $validator;

    public function __construct(CurrencyValidatorInterface $currencyValidator, array $ratio)
    {
        $this->validator = $currencyValidator;
        $this->ratio = $ratio;
    }

    public function compute(string $amount, string $rate, string $alpha): string
    {
        $commissionRate = $this->validator->validate($alpha) ? $this->ratio['eu'] : $this->ratio['non_eu'];

        $amountFixed = ($alpha === 'EUR' || $rate === '0') ? $amount : bcdiv($amount, $rate);

        return bcmul($amountFixed, (string)$commissionRate, 2);
    }
}

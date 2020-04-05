<?php
declare(strict_types=1);

namespace App\Services\ExchangeRate;

interface ExchangeRateInterface
{
    public function getRate(string $currency): string;
}

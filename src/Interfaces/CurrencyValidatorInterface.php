<?php
declare(strict_types=1);

namespace App\Interfaces;

interface CurrencyValidatorInterface
{
    public function validate(string $currencyAlpha): bool;
}

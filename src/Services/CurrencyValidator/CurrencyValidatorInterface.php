<?php
declare(strict_types=1);

namespace App\Services\CurrencyValidator;

interface CurrencyValidatorInterface
{
    public function validate(string $currencyAlpha): bool;
}
